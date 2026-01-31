# Escola da fé

## 📚 Projeto de Faculdade
Projeto desenvolvido durante as aulas do curso, aplicando conhecimentos de **HTML, CSS e JavaScript**.

![Preview do Projeto]()

## 🚀 Descrição
Site estático desenvolvido com:
- **HTML5** para estruturação do conteúdo
- **CSS3** para estilização e layout responsivo
- **JavaScript** para integração de API

## 🔧 Instruções de Uso

### Acesso Online
O projeto está hospedado no Vercel, link abaixo:  
🔗 [Escola da fé](https://escola-da-fe.vercel.app/)

### Execução Local
1. Clone o repositório:
   ```bash
   git clone https://github.com/Tue-GBS/escola-da-fe.git

📄 Licença

Este projeto está licenciado sob a MIT License - veja o arquivo <a href="license.text">License</a> para detalhes.

## 🐳 Rodando com Docker

1. Construa a imagem e inicie o container (usa `docker-compose`):
   ```bash
   docker compose build
   docker compose up -d
   ```

2. Abra o navegador em: `http://localhost:8080`

3. Para parar e remover containers:
   ```bash
   docker compose down
   ```

## ⚙️ Pré-requisitos

Antes de executar os comandos Docker você precisa ter instalado e configurado:

- Docker (Desktop para Windows/Mac, ou Docker Engine no Linux): https://www.docker.com/get-started
- Docker Compose (plugin Compose v2 ou binário `docker-compose`): https://docs.docker.com/compose/install/

Se você usar os scripts `install.sh` ou `run.ps1`, eles também irão checar a presença dessas ferramentas e mostrar links úteis caso estejam faltando.

## 🧰 Scripts de instalação rápida

Você pode usar um script simples para baixar um `docker-compose.yml` (se não existir), copiar `.env.example` → `.env` e subir os containers.

- Linux / macOS:

```bash
# Se você já tem um `docker-compose.yml` no diretório, rode:
./install.sh

# Se precisar baixar o `docker-compose.yml` de uma URL, passe a URL via variável de ambiente:
DOCKER_COMPOSE_URL="https://raw.githubusercontent.com/<usuario>/<repo>/main/docker-compose.yml" ./install.sh
```

- Windows PowerShell:

```powershell
# Se você já tem um `docker-compose.yml` no diretório, rode:
.\run.ps1

# Se precisar baixar o `docker-compose.yml` de uma URL, passe a URL como parâmetro:
.\run.ps1 -DockerComposeUrl "https://raw.githubusercontent.com/<usuario>/<repo>/main/docker-compose.yml"
```

Os scripts irão exibir mensagens de erro claras caso não encontrem um `docker-compose.yml` local e você não fornecer uma URL. Evite copiar URLs genéricas — se quiser incluir uma URL no README, substitua `<usuario>/<repo>` pela URL real do seu repositório.

   ## 🌐 Variáveis de ambiente e múltiplos ambientes

- A aplicação suporta a variável de ambiente `BASE_URL` para ajustar a URL base (útil em produção ou quando estiver em subdiretório). Exemplo de valor: `/` ou `https://meu-dominio.com/`.
- Também é possível definir `APP_ENV` (ex: `development` ou `production`).

### BASE_URL - Configuração de Caminhos

A variável `BASE_URL` é crítica quando o projeto é servido em diferentes contextos:

- **Localhost (raiz):** `BASE_URL=/`
- **Domínio (raiz):** `BASE_URL=/` ou deixar em branco (padrão)
- **Subpasta:** `BASE_URL=/escola-da-fe/` (com barra no final)
- **Domínio customizado:** `BASE_URL=https://meu-dominio.com/`

Todos os caminhos de **assets** (CSS, JS, imagens) e **links internos** usam `<?= $base_url ?>` para garantir compatibilidade:

```php
<!-- Correto: usa $base_url -->
<link rel="stylesheet" href="<?= $base_url ?>css/main.css">
<img src="<?= $base_url ?>assets/img/logo.png" alt="Logo">
<a href="<?= $base_url ?>index.php">Início</a>

<!-- Errado: pode quebrar em subpastas -->
<link rel="stylesheet" href="/css/main.css">
<img src="/assets/img/logo.png" alt="Logo">
```

A variável `$base_url` é automaticamente calculada em `partials/header.php` e pode ser sobrescrita por variável de ambiente:

```bash
# via .env ou docker-compose
BASE_URL=/escola-da-fe/ docker compose up
```

Exemplo de `docker-compose` em produção (usa `docker-compose.prod.yml`):

   ```bash
   # define variáveis antes de rodar (ou crie um arquivo .env.prod)
   export IMAGE_NAME=meuusuario/escola-da-fe:1.0
   export BASE_URL=/

   docker compose -f docker-compose.prod.yml up -d --build
   ```

   ## 📦 Publicar imagem no Docker Hub via GitHub Actions

   1. No repositório GitHub, crie os secrets `DOCKERHUB_USERNAME` e `DOCKERHUB_TOKEN` (token do Docker Hub).
   2. O workflow em `.github/workflows/docker-publish.yml` fará build e push automático quando der push na branch `main`.
