# Escola da Fé

Projeto desenvolvido como **trabalho de faculdade**, com o objetivo de criar um **site institucional moderno, organizado e responsivo**, aplicando boas práticas de desenvolvimento web, reaproveitamento de componentes e preparação para ambientes de desenvolvimento e produção com **Docker**.

O projeto simula um site real de uma iniciativa educacional/religiosa chamada **Escola da Fé**, com foco em clareza das informações, estrutura limpa e facilidade de manutenção.

🔗 **Demo (Vercel):** https://escola-da-fe.vercel.app

---

## ✨ Funcionalidades e Objetivos

- Site institucional com páginas organizadas
- Uso de **partials em PHP** (header, footer, seções reutilizáveis)
- Estrutura clara de **assets** (CSS, JS e imagens)
- Execução local simples
- Execução isolada e reproduzível via **Docker**
- Scripts de instalação rápida (Linux/macOS e Windows)
- Base preparada para **CI/CD**
- Separação de ambiente de desenvolvimento e produção

---

## 🧱 Tecnologias Utilizadas

- **PHP**
- **HTML5**
- **CSS3**
- **JavaScript**
- **Docker**
- **Docker Compose**
- **PowerShell** (scripts auxiliares)

---

## 📁 Estrutura do Projeto

```bash
escola-da-fe/
├── assets/                # Arquivos estáticos (CSS, JS, imagens)
├── partials/              # Componentes reutilizáveis (header, footer, etc.)
├── .env.example           # Exemplo de variáveis de ambiente
├── Dockerfile             # Definição da imagem Docker
├── docker-compose.yml     # Ambiente local / desenvolvimento
├── docker-compose.prod.yml# Ambiente de produção
├── install.sh             # Script de instalação (Linux/macOS)
├── run.ps1                # Script de instalação (Windows)
├── index.php              # Entrada principal do site
└── README.md
✅ Requisitos
Para rodar com Docker (recomendado)

Docker

Docker Compose (docker compose)

Para rodar sem Docker

PHP 8 ou superior

Navegador web

🚀 Como executar o projeto

Você pode rodar o projeto de três formas diferentes.

🔹 Opção 1 — Rodar com Docker (manual)

Clone o repositório:

git clone https://github.com/Tue-GBS/escola-da-fe.git
cd escola-da-fe


Construa e suba os containers:

docker compose build
docker compose up -d


Acesse no navegador:

http://localhost:8080


Para parar o projeto:

docker compose down

🔹 Opção 2 — Instalação rápida (Linux / macOS) — install.sh

O script install.sh automatiza o processo de subida do projeto.

📋 O que ele faz:

Verifica se existe docker-compose.yml

Caso não exista, permite baixar via URL

Cria o .env a partir do .env.example (se necessário)

Executa docker compose up -d

Como usar:

Clone o projeto:

git clone https://github.com/Tue-GBS/escola-da-fe.git
cd escola-da-fe


Dê permissão de execução ao script (apenas uma vez):

chmod +x install.sh


Execute o script:

./install.sh


🔧 Opcional — baixar o docker-compose.yml automaticamente:

DOCKER_COMPOSE_URL="https://raw.githubusercontent.com/Tue-GBS/escola-da-fe/master/docker-compose.yml" ./install.sh

🔹 Opção 3 — Instalação rápida (Windows) — run.ps1

O run.ps1 é a alternativa para usuários Windows.

📋 O que ele faz:

Verifica Docker

Cria .env se não existir

Sobe os containers automaticamente

Como usar:

Clone o repositório:

git clone https://github.com/Tue-GBS/escola-da-fe.git
cd escola-da-fe


Execute o script:

.\run.ps1


🔧 Opcional — informar URL do compose:

.\run.ps1 -DockerComposeUrl "https://raw.githubusercontent.com/Tue-GBS/escola-da-fe/master/docker-compose.yml"

⚙️ Variáveis de Ambiente

O projeto utiliza variáveis de ambiente centralizadas no arquivo .env.

.env.example → exemplo versionado

.env → configuração local (não versionar)

Principais variáveis
BASE_URL=http://localhost:8080
APP_ENV=development

BASE_URL

Utilizada para corrigir caminhos de assets e links quando o projeto:

roda em subdiretório

roda em domínio real

roda em container

Exemplos:

/

http://localhost:8080

https://meusite.com

🏭 Ambiente de Produção (Docker)

Para rodar em produção:

docker compose -f docker-compose.prod.yml up -d --build


Caso o compose utilize imagem pronta:

export IMAGE_NAME=seuusuario/escola-da-fe:1.0
export BASE_URL=/
docker compose -f docker-compose.prod.yml up -d

🤖 CI/CD — GitHub Actions

O projeto possui pipeline de CI/CD para build e publicação de imagem Docker.

📌 Funciona da seguinte forma:

Executa ao dar push na branch master

Constrói a imagem Docker

Publica no Docker Hub

Secrets necessários no GitHub:

DOCKERHUB_USERNAME

DOCKERHUB_TOKEN

🧯 Problemas Comuns
Porta 8080 ocupada

Altere o mapeamento no docker-compose.yml, por exemplo:

ports:
  - "8081:80"


Acesse:

http://localhost:8081

📜 Licença

Projeto de caráter educacional.
Uso livre para estudos e adaptações.

👨‍💻 Autor

Mateus Gonçalves 
Projeto acadêmico — Escola da Fé


---

Se quiser, o próximo passo pode ser:
- 🧼 revisar e melhorar os **scripts `install.sh` e `run.ps1`**
- 🐳 revisar **Dockerfile e docker-compose**
- 🔁 adaptar o README para **deploy real em VPS**
- 🌐 converter o projeto para **100% estático**

Você mandou muito bem nesse projeto — agora o README está no nível de projeto sério 👊