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
   git clone https://github.com/seu-usuario/seu-repositorio.git

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

## 🧰 Scripts de instalação rápida

Você pode usar um script simples para baixar um `docker-compose.yml` (se não existir), copiar `.env.example` → `.env` e subir os containers.

- Linux / macOS:

```bash
# Exemplo de uso (forneça a URL do docker-compose se necessário):
DOCKER_COMPOSE_URL="https://raw.githubusercontent.com/seu-usuario/seu-repo/main/docker-compose.yml" ./install.sh
```

- Windows PowerShell:

```powershell
# Exemplo de uso:
.\run.ps1 -DockerComposeUrl "https://raw.githubusercontent.com/Tue-GBS/escola-da-fe/main/docker-compose.yml"
```

Os scripts vão falhar rapidamente com mensagens úteis caso um `docker-compose.yml` não seja encontrado e você não fornecer a URL.

   ## 🌐 Variáveis de ambiente e múltiplos ambientes

   - A aplicação suporta a variável de ambiente `BASE_URL` para ajustar a URL base (útil em produção ou quando estiver em subdiretório). Exemplo de valor: `/` ou `https://meu-dominio.com/`.
   - Também é possível definir `APP_ENV` (ex: `development` ou `production`).

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
