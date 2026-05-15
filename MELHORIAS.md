# Melhorias do projeto Escola da Fe

## Problemas encontrados

- Textos com codificacao quebrada em varias paginas.
- `footer.php` abria uma nova tag `<body>`, gerando HTML invalido.
- `partials/video.php` fechava o `<main>` dentro do loop de videos.
- CSS com blocos duplicados e regras antigas pouco consistentes.
- JavaScript fazia requisicao externa em todas as paginas, mesmo sem elementos para receber os dados.
- Menu tinha links para arquivos inexistentes ou secoes ainda nao implementadas.
- Conteudos ficavam misturados com layout, dificultando manutencao.
- README descrevia algumas capacidades de forma maior do que a implementacao real.
- Docker funcionava de forma basica, mas podia ser mais claro e alinhado ao uso em desenvolvimento/producao.

## Alteracoes feitas

- Reorganizei a aplicacao em `config/`, `partials/` e `assets/`.
- Criei `config/app.php` com helpers para URL, assets, ambiente e escape HTML.
- Criei `config/content.php` para centralizar menu, videos, aulas, beneficios e contatos.
- Reescrevi `index.php` como ponto unico de montagem da home institucional.
- Transformei os partials em componentes reutilizaveis: header, nav, hero, sobre, videos, beneficios, contato e footer.
- Recriei o CSS em `assets/css/main.css` com variaveis, responsividade e layout moderno.
- Reduzi o JavaScript a interacao necessaria do menu mobile.
- Recriei Dockerfile, `docker-compose.yml` e `docker-compose.prod.yml`.
- Criei `.dockerignore`.
- Simplifiquei `.env.example` com apenas variaveis usadas ou plausiveis para este projeto.
- Removi `ERROS_E_PROBLEMAS.md`, substituido por este arquivo de melhorias.
- Atualizei o README com instrucoes coerentes com a nova estrutura.

## Decisoes tecnicas

- Mantive PHP puro para preservar simplicidade, baixo custo de hospedagem e facilidade de apresentacao.
- Nao usei Laravel, React, Next.js ou Vite porque o projeto e institucional, pequeno e nao precisa de build step.
- Usei arrays PHP para conteudo repetitivo, especialmente videos e cards, porque isso resolve manutencao sem adicionar banco de dados.
- Usei YouTube no dominio `youtube-nocookie.com` para embeds mais adequados a privacidade.
- Mantive Docker como opcao recomendada de execucao, mas o projeto tambem roda com `php -S`.

## Sugestoes futuras

- Criar paginas internas para trilhas completas de catequese.
- Adicionar area de liturgia com fonte revisada e tratamento de falhas.
- Substituir contatos temporarios por canais oficiais.
- Criar formulario com protecao anti-spam.
- Adicionar testes automatizados de HTML e links.
- Melhorar SEO com metatags Open Graph e imagem de compartilhamento.
- Criar um fluxo de deploy documentado para VPS ou hospedagem PHP comum.

## O que ainda pode melhorar

- O conteudo textual ainda pode ser revisado pastoralmente.
- O projeto ainda nao possui painel administrativo.
- O video cadastrado deve ser revisado e trocado por conteudo oficial da Escola da Fe, se necessario.
- As imagens atuais foram reaproveitadas do projeto original; uma identidade visual oficial deixaria o site mais forte.
