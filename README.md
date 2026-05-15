# Escola da Fe

Site institucional simples para a iniciativa **Escola da Fe**, com foco em formacao catolica, aulas, estudos biblicos e contato com a comunidade.

O projeto foi mantido em **PHP puro** porque a necessidade atual e institucional e leve. Isso evita dependencias desnecessarias, facilita hospedagem em qualquer servidor PHP e deixa o codigo mais facil de apresentar, estudar e evoluir.

## Tecnologias

- PHP 8.2
- HTML5
- CSS3 com variaveis e media queries
- JavaScript puro para menu mobile
- Docker e Docker Compose

## Estrutura

```text
.
|-- assets/
|   |-- css/main.css
|   |-- img/
|   `-- js/script.js
|-- config/
|   |-- app.php
|   `-- content.php
|-- partials/
|   |-- beneficios.php
|   |-- contatos.php
|   |-- footer.php
|   |-- header.php
|   |-- hero.php
|   |-- nav.php
|   |-- sobre.php
|   `-- video.php
|-- Dockerfile
|-- docker-compose.yml
|-- docker-compose.prod.yml
|-- index.php
|-- MELHORIAS.md
`-- README.md
```

## Como rodar sem Docker

Requisitos:

- PHP 8 ou superior

Execute na raiz do projeto:

```bash
php -S localhost:8080
```

Acesse:

```text
http://localhost:8080
```

## Como rodar com Docker

Requisitos:

- Docker
- Docker Compose v2

Suba o projeto:

```bash
docker compose up -d --build
```

Acesse:

```text
http://localhost:8080
```

Para parar:

```bash
docker compose down
```

Tambem existem scripts auxiliares simples:

```bash
./install.sh
```

No Windows PowerShell:

```powershell
.\run.ps1
```

## Ambiente

O arquivo `.env.example` contem apenas valores seguros de exemplo. Se precisar sobrescrever configuracoes locais, copie:

```bash
cp .env.example .env
```

Principais variaveis:

```env
BASE_URL=/
APP_ENV=development
IMAGE_NAME=escola-da-fe:latest
HTTP_PORT=80
```

O arquivo `.env` esta no `.gitignore` e nao deve ser versionado.

## Como editar conteudos

Os conteudos principais ficam em:

```text
config/content.php
```

Nesse arquivo voce edita:

- Itens do menu
- Videos do YouTube
- Cards de aulas/conteudos
- Beneficios
- Links de contato

Para adicionar um video, inclua um novo item no array `$videos`:

```php
[
    'title' => 'Titulo da aula',
    'description' => 'Descricao curta da aula.',
    'youtube_id' => 'ID_DO_VIDEO',
]
```

Use somente o ID do video, nao a URL completa. Exemplo: em `https://www.youtube.com/watch?v=abc123`, o ID e `abc123`.

## Deploy

Opcoes simples:

1. Servidor PHP/Apache: envie os arquivos do projeto para o diretorio publico do servidor.
2. Docker em VPS: use `docker-compose.prod.yml` e ajuste as variaveis de ambiente.
3. Imagem Docker: publique a imagem em um registry e configure `IMAGE_NAME`.

Exemplo de producao com Docker:

```bash
docker compose -f docker-compose.prod.yml up -d --build
```

Se a porta 80 estiver ocupada:

```bash
HTTP_PORT=8081 docker compose -f docker-compose.prod.yml up -d --build
```

## Proximos passos

- Criar paginas internas para aulas, agenda e liturgia.
- Trocar os contatos de exemplo pelos canais oficiais.
- Adicionar formulario de contato com validacao.
- Criar painel simples para cadastrar videos sem editar PHP.
- Revisar acessibilidade com testes automatizados.
- Adicionar pipeline de validacao PHP/CSS em CI.
