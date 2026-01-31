# Escola da Fé

## 📚 Projeto
Site desenvolvido como exercício acadêmico usando HTML, CSS, JavaScript e PHP. O repositório contém uma versão estática que pode ser publicada em serviços como Vercel (apenas front-end) e uma versão completa em Docker/PHP para execução do site dinâmico.

---

## 🚀 Descrição
- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP (rodando via Docker + Apache)

## 🔧 Instruções rápidas

### Execução com Docker (recomendado para PHP)
1. Build e subir containers:
```bash
docker compose build
docker compose up -d
```
2. Acesse: `http://localhost:8080` (o `docker-compose.yml` deste projeto expõe `8080:80`)
3. Parar/remover:
```bash
docker compose down
```

### Hospedagem estática (Vercel)
- O repositório tem uma versão estática que pode ser implantada no Vercel (HTML/CSS/JS). O Vercel NÃO executa código PHP nativamente.
- Se você publicar no Vercel, só o conteúdo estático (páginas HTML, CSS, JS) ficará disponível.
- Para funcionalidades PHP (formulários processados no servidor, templates PHP), use Docker, um servidor PHP (Apache/Nginx+PHP-FPM) ou um serviço que suporte PHP.

## ⚙️ Pré-requisitos
- Docker: https://www.docker.com/get-started
- Docker Compose: https://docs.docker.com/compose/install/

Se usar os scripts `install.sh` ou `run.ps1`, eles checam essas dependências automaticamente.

## 🌐 BASE_URL — configuração e exemplos

A aplicação usa a variável `BASE_URL` para construir caminhos de assets e links internos. Isso evita que caminhos absolutos quebrem quando o site é servido em subpasta ou domínio customizado.

- Exemplos de valores:
  - Servindo na raiz do localhost (desenvolvimento): `BASE_URL=/`
  - Servindo na raiz de um domínio: `BASE_URL=/` ou `BASE_URL=https://meu-dominio.com/`
  - Servindo em subpasta (ex.: GitHub Pages ou subdiretório): `BASE_URL=/escola-da-fe/` (observe a barra final)

- Como usar (exemplos em PHP):

```php
<!-- Correto: usa $base_url definido em partials/header.php -->
<link rel="stylesheet" href="<?= $base_url ?>css/main.css">
<img src="<?= $base_url ?>assets/img/logo.png" alt="Logo">
<a href="<?= $base_url ?>index.php">Início</a>
```

- Como definir via `docker-compose` / `.env`:

```yaml
services:
  web:
    environment:
      - BASE_URL=/escola-da-fe/
```

ou criando um `.env` com:

```
BASE_URL=/escola-da-fe/
```

> Observação: mantenha apenas `.env.example` versionado. NÃO comite `.env` real com segredos.

## 🧰 Scripts úteis

- `install.sh` (Linux/macOS): ajuda a baixar `docker-compose.yml` (se necessário), cria `.env` a partir de `.env.example` e sobe containers.
- `run.ps1` (Windows PowerShell): equivalente para Windows.

Exemplos:

```bash
# baixando docker-compose de um repositório remoto (substitua <usuario>/<repo>):
DOCKER_COMPOSE_URL="https://raw.githubusercontent.com/<usuario>/<repo>/master/docker-compose.yml" ./install.sh
```

```powershell
# Exemplo PowerShell
.\run.ps1 -DockerComposeUrl "https://raw.githubusercontent.com/<usuario>/<repo>/master/docker-compose.yml"
```

## 🔐 Boas práticas
- Não mantenha `.env` com chaves no repositório. Use `.env.example` (valores fictícios) e adicione `.env` ao `.gitignore`.
- Use secrets do provedor (GitHub Secrets, Docker secrets) para CI/CD.

## 📦 CI / Publicação de imagem Docker
- O workflow em `.github/workflows/docker-publish.yml` publica imagem quando há push na branch `master`.
- Crie secrets `DOCKERHUB_USERNAME` e `DOCKERHUB_TOKEN` no GitHub para permitir push.

---

Se quiser, posso: validar `.gitignore`, garantir que `.env` não está rastreado, ou preparar um pequeno guia de deploy para Vercel + Docker.
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
DOCKER_COMPOSE_URL="https://raw.githubusercontent.com/<usuario>/<repo>/master/docker-compose.yml" ./install.sh
```

- Windows PowerShell:

```powershell
# Se você já tem um `docker-compose.yml` no diretório, rode:
.\run.ps1

# Se precisar baixar o `docker-compose.yml` de uma URL, passe a URL como parâmetro:
.\run.ps1 -DockerComposeUrl "https://raw.githubusercontent.com/<usuario>/<repo>/master/docker-compose.yml"
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
   2. O workflow em `.github/workflows/docker-publish.yml` fará build e push automático quando der push na branch `master`.
