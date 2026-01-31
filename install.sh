#!/usr/bin/env bash
set -euo pipefail

# install.sh
# Uso:
#  ./install.sh                 # usa docker-compose.yml local (se existir) e sobe
#  ./install.sh -u <URL>        # baixa o docker-compose.yml da URL fornecida e sobe
#  ./install.sh -m|--menu       # abre menu interativo (passo a passo)
#  ./install.sh -s 1,2,3,4      # executa etapas em sequência (sem interação)
#  DOCKER_COMPOSE_URL=... ./install.sh  # também funciona via env var

show_help() {
  cat <<EOF
Usage: $0 [-u URL] [--force] [-m|--menu] [-s|--steps STEPS]

Options:
  -u, --url URL       URL para baixar o docker-compose.yml (opcional)
  -f, --force         Força sobrescrever docker-compose.yml existente
  -h, --help          Mostra esta ajuda
  -m, --menu          Abre menu interativo para preparar ambiente passo a passo
  -s, --steps STEPS   Executa etapas em sequência (ex: -s 1,2,3,4 ou -s 1-4)
                      Etapas disponíveis:
                        1) Verificar pré-requisitos (Docker e Docker Compose)
                        2) Baixar docker-compose.yml (requer -u com URL)
                        3) Configurar arquivo .env (copia .env.example → .env)
                        4) Iniciar containers (docker compose up -d --build)
                        5) Parar e remover containers (docker compose down)

Você pode também setar DOCKER_COMPOSE_URL como variável de ambiente.
Evite usar exemplos com placeholders (ex: "<usuario>", "seu-usuario").
EOF
}

is_placeholder() {
  local url="$1"
  # detecta palavras comuns de placeholder
  if [[ "$url" =~ "seu-usuario" ]] || [[ "$url" =~ "seu-repo" ]] || \
     [[ "$url" =~ "<usuario>" ]] || [[ "$url" =~ "<repo>" ]] || \
     [[ "$url" =~ "your-username" ]] || [[ "$url" =~ "example" ]]; then
    return 0
  fi
  return 1
}

URL="${DOCKER_COMPOSE_URL:-}";
FORCE=0
MENU=0
STEPS=""

while [[ "$#" -gt 0 ]]; do
  case "$1" in
    -u|--url)
      URL="$2"; shift 2;;
    -f|--force)
      FORCE=1; shift;;
    -m|--menu)
      MENU=1; shift;;
    -s|--steps)
      STEPS="$2"; shift 2;;
    -h|--help)
      show_help; exit 0;;
    *)
      echo "Parâmetro desconhecido: $1"; show_help; exit 1;;
  esac
done

if [[ -z "$URL" ]] && [[ -n "${DOCKER_COMPOSE_URL:-}" ]]; then
  URL="$DOCKER_COMPOSE_URL"
fi

if [[ -f docker-compose.yml && $FORCE -ne 1 ]]; then
  echo "Arquivo docker-compose.yml já existe. Use --force para sobrescrever ou remova o arquivo se quiser baixar um novo."
else
  if [[ -z "$URL" ]]; then
    if [[ -f docker-compose.yml ]]; then
      echo "Usando docker-compose.yml local existente."
    else
      echo "docker-compose.yml não encontrado e nenhuma URL foi fornecida. Saindo." >&2
      exit 1
    fi
  else
    if is_placeholder "$URL"; then
      echo "A URL fornecida parece conter placeholders. Substitua '<usuario>/<repo>' pela URL real do seu repositório." >&2
      exit 1
    fi

    echo "Baixando docker-compose.yml de $URL"
    if command -v curl >/dev/null 2>&1; then
      curl -fsSL "$URL" -o docker-compose.yml || { echo "Falha ao baixar com curl" >&2; exit 1; }
    elif command -v wget >/dev/null 2>&1; then
      wget -qO docker-compose.yml "$URL" || { echo "Falha ao baixar com wget" >&2; exit 1; }
    else
      echo "Nem curl nem wget encontrados. Instale um deles ou coloque o docker-compose.yml manualmente." >&2
      exit 1
    fi

    # validação simples do conteúdo
    if ! grep -q "services:" docker-compose.yml; then
      echo "O arquivo baixado não parece ser um docker-compose válido (campo 'services:' não encontrado)." >&2
      rm -f docker-compose.yml
      exit 1
    fi
  fi
fi

if [[ -f .env.example && ! -f .env ]]; then
  cp .env.example .env
  echo ".env criado a partir de .env.example"
fi

echo "Subindo containers (docker compose up -d --build)..."
check_docker_and_compose() {
  # Verifica se o comando docker existe
  if ! command -v docker >/dev/null 2>&1; then
    echo "Docker não encontrado. Instale o Docker:" >&2
    echo " - Docker Desktop (Windows/Mac): https://www.docker.com/get-started" >&2
    echo " - Docker Engine (Linux): https://docs.docker.com/engine/install/" >&2
    exit 1
  fi

  # Verifica se o daemon do Docker está acessível (opcional)
  if ! docker info >/dev/null 2>&1; then
    echo "O Docker está instalado mas o daemon não está acessível. Verifique se o Docker está rodando (ex.: abra o Docker Desktop)." >&2
    echo "Se precisar instalar/consultar instruções: https://www.docker.com/get-started" >&2
    exit 1
  fi

  # Verifica se o plugin 'docker compose' está disponível; se não, tenta o binário legacy 'docker-compose'
  if docker compose version >/dev/null 2>&1; then
    COMPOSE_MODE="v2"
  elif command -v docker-compose >/dev/null 2>&1; then
    COMPOSE_MODE="legacy"
  else
    echo "Docker Compose não encontrado. Instale o Docker Compose (plugin Compose v2) ou o binário 'docker-compose':" >&2
    echo " - Install Compose v2 (plugin): https://docs.docker.com/compose/install/" >&2
    echo " - Legacy docker-compose (se necessário): https://docs.docker.com/compose/install/" >&2
    exit 1
  fi
}

check_docker_and_compose

# Processa etapas se --steps foi fornecido
if [[ -n "$STEPS" ]]; then
  # expande ranges como 1-4 para 1,2,3,4
  STEPS=$(echo "$STEPS" | sed 's/-/,/g' | sed 's/[^0-9,]//g')

  download_compose_interactive() {
    if [[ -f docker-compose.yml && $FORCE -ne 1 ]]; then
      echo "Já existe docker-compose.yml local. Use --force para sobrescrever ou remova o arquivo manualmente."
      return 0
    fi
    if [[ -z "$URL" ]]; then
      echo "⚠️  Nenhuma URL fornecida para download. Pulando etapa 2."
      return 0
    fi
    if is_placeholder "$URL"; then
      echo "A URL parece conter placeholders. Substitua '<usuario>/<repo>' pela URL real do seu repositório." >&2
      return 1
    fi
    echo "📥 Etapa 2: Baixando docker-compose.yml de $URL"
    if command -v curl >/dev/null 2>&1; then
      curl -fsSL "$URL" -o docker-compose.yml || { echo "Falha ao baixar com curl" >&2; return 1; }
    elif command -v wget >/dev/null 2>&1; then
      wget -qO docker-compose.yml "$URL" || { echo "Falha ao baixar com wget" >&2; return 1; }
    else
      echo "Nem curl nem wget encontrados. Instale um deles ou coloque o docker-compose.yml manualmente." >&2
      return 1
    fi
    if ! grep -q "services:" docker-compose.yml; then
      echo "Arquivo baixado não parece ser um docker-compose válido." >&2; rm -f docker-compose.yml; return 1
    fi
    echo "✅ docker-compose.yml baixado com sucesso."
  }

  create_env_if_missing() {
    echo "📝 Etapa 3: Criando .env"
    if [[ -f .env.example && ! -f .env ]]; then
      cp .env.example .env
      echo "✅ .env criado a partir de .env.example"
    else
      if [[ -f .env ]]; then
        echo "ℹ️  .env já existe."
      else
        echo "ℹ️  .env.example não encontrado."
      fi
    fi
  }

  start_containers() {
    echo "🐳 Etapa 4: Subindo containers (docker compose up -d --build)"
    if [[ "$COMPOSE_MODE" == "v2" ]]; then
      docker compose up -d --build || return 1
    else
      docker-compose up -d --build || return 1
    fi
    echo "✅ Containers iniciados. Acesse http://localhost:8080 (ou a porta configurada)."
  }

  stop_containers() {
    echo "🛑 Etapa 5: Parando e removendo containers"
    if [[ "$COMPOSE_MODE" == "v2" ]]; then
      docker compose down || return 1
    else
      docker-compose down || return 1
    fi
    echo "✅ Containers parados e removidos."
  }

  # itera pelas etapas fornecidas
  IFS=',' read -ra STEP_ARRAY <<< "$STEPS"
  for step in "${STEP_ARRAY[@]}"; do
    step=$(echo "$step" | xargs)  # remove espaços
    case "$step" in
      1)
        echo "🔍 Etapa 1: Verificando pré-requisitos"
        check_docker_and_compose || { echo "❌ Falha na etapa 1. Parando." >&2; exit 1; }
        echo "✅ Pré-requisitos verificados com sucesso."
        ;;
      2)
        echo "📥 Etapa 2: Baixando docker-compose.yml"
        download_compose_interactive || { echo "❌ Falha na etapa 2. Parando." >&2; exit 1; }
        ;;
      3)
        echo "📝 Etapa 3: Configurando .env"
        create_env_if_missing || { echo "❌ Falha na etapa 3. Parando." >&2; exit 1; }
        ;;
      4)
        echo "🐳 Etapa 4: Iniciando containers"
        start_containers || { echo "❌ Falha na etapa 4. Parando." >&2; exit 1; }
        ;;
      5)
        echo "🛑 Etapa 5: Parando containers"
        stop_containers || { echo "❌ Falha na etapa 5. Parando." >&2; exit 1; }
        ;;
      *)
        echo "⚠️  Etapa inválida: $step (use 1-5)"
        ;;
    esac
  done
  exit 0
fi

if [[ "$MENU" -eq 1 ]]; then
  # Menu interativo
  show_menu() {
    cat <<'MENU'
=================================================
  Menu de Instalação - Preparar Ambiente
=================================================
Escolha uma opção:

  [1] Verificar pré-requisitos
      Valida se Docker e Docker Compose estão instalados

  [2] Baixar docker-compose.yml
      Baixa configuração do Docker de uma URL (requer -u)

  [3] Configurar arquivo .env
      Copia .env.example → .env

  [4] Iniciar containers
      Executa: docker compose up -d --build

  [5] Parar e remover containers
      Executa: docker compose down

  [a] Executar todas as etapas em ordem
      Executa: 1 → 2 → 3 → 4

  [q] Sair
=================================================
MENU
  }

  download_compose_interactive() {
    if [[ -f docker-compose.yml && $FORCE -ne 1 ]]; then
      echo "Já existe docker-compose.yml local. Use --force para sobrescrever ou remova o arquivo manualmente."
      return
    fi
    if [[ -z "$URL" ]]; then
      read -p "Forneça a URL para docker-compose.yml (ou enter para cancelar): " inputUrl
      URL="$inputUrl"
    fi
    if [[ -z "$URL" ]]; then
      echo "Nenhuma URL fornecida. Pulando download."
      return
    fi
    if is_placeholder "$URL"; then
      echo "A URL parece conter placeholders. Substitua '<usuario>/<repo>' pela URL real do seu repositório." >&2
      return
    fi
    echo "Baixando docker-compose.yml de $URL"
    if command -v curl >/dev/null 2>&1; then
      curl -fsSL "$URL" -o docker-compose.yml || { echo "Falha ao baixar com curl" >&2; return 1; }
    elif command -v wget >/dev/null 2>&1; then
      wget -qO docker-compose.yml "$URL" || { echo "Falha ao baixar com wget" >&2; return 1; }
    else
      echo "Nem curl nem wget encontrados. Instale um deles ou coloque o docker-compose.yml manualmente." >&2
      return 1
    fi
    if ! grep -q "services:" docker-compose.yml; then
      echo "Arquivo baixado não parece ser um docker-compose válido." >&2; rm -f docker-compose.yml; return 1
    fi
    echo "docker-compose.yml baixado com sucesso."
  }

  create_env_if_missing() {
    if [[ -f .env.example && ! -f .env ]]; then
      cp .env.example .env
      echo ".env criado a partir de .env.example"
    else
      echo ".env já existe ou .env.example ausente."
    fi
  }

  start_containers() {
    if [[ "$COMPOSE_MODE" == "v2" ]]; then
      docker compose up -d --build
    else
      docker-compose up -d --build
    fi
  }

  stop_containers() {
    if [[ "$COMPOSE_MODE" == "v2" ]]; then
      docker compose down
    else
      docker-compose down
    fi
  }

  # loop do menu
  while true; do
    show_menu
    read -p "Opção> " opt
    case "$opt" in
      1)
        echo "🔍 Etapa 1: Verificando pré-requisitos..."
        check_docker_and_compose || true
        echo ""
        ;;
      2)
        echo "📥 Etapa 2: Baixando docker-compose.yml..."
        download_compose_interactive || true
        echo ""
        ;;
      3)
        echo "📝 Etapa 3: Configurando .env..."
        create_env_if_missing || true
        echo ""
        ;;
      4)
        echo "🐳 Etapa 4: Iniciando containers..."
        start_containers || true
        echo ""
        ;;
      5)
        echo "🛑 Etapa 5: Parando containers..."
        stop_containers || true
        echo ""
        ;;
      a)
        echo ""
        echo "⚡ Executando todas as etapas em ordem (1 → 2 → 3 → 4)..."
        echo ""
        check_docker_and_compose && download_compose_interactive && create_env_if_missing && start_containers
        echo ""
        ;;
      q)
        echo "👋 Saindo."; exit 0 ;;
      *)
        echo "❌ Opção inválida. Tente novamente."; echo ""
        ;;
    esac
  done
else
  # modo não interativo: apenas sobe os containers (comportamento legado)
  if [[ "$COMPOSE_MODE" == "v2" ]]; then
    docker compose up -d --build
  else
    docker-compose up -d --build
  fi
  echo "Containers iniciados. Acesse http://localhost:8080 (ou a porta configurada)."
fi
#!/usr/bin/env bash
set -euo pipefail

# Uso: DOCKER_COMPOSE_URL=https://exemplo/raw/docker-compose.yml ./install.sh

if [ ! -f docker-compose.yml ]; then
  if [ -z "${DOCKER_COMPOSE_URL:-}" ]; then
    echo "Arquivo docker-compose.yml não encontrado e DOCKER_COMPOSE_URL não definido. Saindo."
    exit 1
  fi
  echo "Baixando docker-compose.yml de $DOCKER_COMPOSE_URL"
  if command -v curl >/dev/null 2>&1; then
    curl -fsSL "$DOCKER_COMPOSE_URL" -o docker-compose.yml
  else
    wget -qO docker-compose.yml "$DOCKER_COMPOSE_URL"
  fi
fi

if [ -f .env.example ] && [ ! -f .env ]; then
  cp .env.example .env
  echo "Arquivo .env criado a partir de .env.example"
fi

# Subir containers
docker compose up -d --build
