# 📋 Erros e Problemas do Projeto - Por Ordem de Prioridade

## 🔴 PRIORIDADE CRÍTICA

### 1. **Elementos HTML não encontrados no DOM**
- **Arquivo:** `assets/js/script.js`
- **Problema:** O script tenta acessar elementos que não existem nas páginas:
  - `#titulo-liturgia`
  - `#data-liturgia`
  - `#cor-liturgia`
  - `#oracao-coleta`
  - `#primeira-leitura-referencia`
  - `#primeira-leitura-texto`
- **Impacto:** Erros no console, funcionalidade quebrada
- **Solução:** 
  - Criar página `partials/homilia.php` com esses elementos
  - Ou adicionar verificações de existência dos elementos no JS

### 2. **Arquivos referenciados que não existem**
- **Arquivo:** `partials/nav.php`
- **Problemas encontrados:**
  - `liturgia/homilia.php` - não existe
  - `html/video.html` - referenciado como video.html mas deve ser partials/video.php
  - `oracoes/comuns.html` - não existe
  - `assets/img/logo.png` - não existe (falta imagem)
  - `assets/img/banner.png` - não existe
  - `assets/img/img-padre.jpg` - não existe
  - `assets/img/dom-francisco.png` - não existe
- **Impacto:** Links quebrados, imagens faltando
- **Solução:** Criar os arquivos ou atualizar os links

---

## 🟠 PRIORIDADE ALTA

### 3. **Menu ainda não implementado completamente**
- **Arquivo:** `assets/js/script.js`
- **Problema:** Não há código JavaScript para ativar/desativar menus, abrir/fechar submenus
- **Impacto:** Menu é estático, não funciona
- **Solução:** Adicionar event listeners aos botões `.menu-toggle` e `.menu-label`

### 4. **Página contatos.php vazia**
- **Arquivo:** `partials/contatos.php`
- **Problema:** Arquivo referenciado no menu mas não implementado
- **Impacto:** Link leva para página em branco
- **Solução:** Implementar formulário de contato ou conteúdo

### 5. **Página sobre.php vazia**
- **Arquivo:** `partials/sobre.php`
- **Problema:** Arquivo referenciado no menu mas não implementado
- **Impacto:** Link leva para página em branco
- **Solução:** Adicionar conteúdo sobre a paróquia

---

## 🟡 PRIORIDADE MÉDIA

### 6. **Tratamento de erros inadequado no fetch**
- **Arquivo:** `assets/js/script.js`
- **Problema:** 
  - Sem validação se `liturgia.leituras.primeiraLeitura` existe
  - Sem tratamento se `leituraPrincipal.referencia` ou `.texto` não existem
- **Impacto:** Erros silenciosos ou indefinidos no console
- **Solução:** Adicionar verificações de existência antes de acessar propriedades

### 7. **CSS em layout responsivo pode ter problemas**
- **Arquivo:** `css/main.css`
- **Problema:** Menu com `flex-wrap` pode quebrar em mobile
- **Impacto:** Interface pode ficar confusa em celulares
- **Solução:** Adicionar media queries e testes em mobile

### 8. **Compatibilidade de navegadores**
- **Arquivo:** Todo o projeto
- **Problema:** Usando features modernas (Fetch API, CSS Grid, etc)
- **Impacto:** Pode não funcionar em IE11 ou navegadores antigos
- **Solução:** Adicionar polyfills ou avisar sobre browsers suportados

---

## 🟢 PRIORIDADE BAIXA

### 9. **Footer sem conteúdo estruturado**
- **Arquivo:** `partials/footer.php`
- **Problema:** Footer muito simples, sem links úteis ou copyright
- **Impacto:** Falta informações importantes
- **Solução:** Melhorar estrutura do footer com links, redes sociais, etc

### 10. **Documentação incompleta**
- **Arquivo:** `readme.md`
- **Problema:** Instruções de clone com placeholders (`seu-usuario/seu-repositorio`)
- **Impacto:** Usuários não conseguem clonar corretamente
- **Solução:** Atualizar com repositório real

### 11. **Sem validação de formulário**
- **Arquivo:** Não aplicável ainda
- **Problema:** Quando formulário for criado, não terá validação
- **Solução:** Implementar validação frontend e backend

### 12. **Performance não otimizada**
- **Arquivo:** `css/main.css` e `assets/js/script.js`
- **Problema:** 
  - CSS não está minificado
  - Imagens não otimizadas
  - Sem lazy loading
- **Impacto:** Carregamento mais lento
- **Solução:** Minificar, otimizar imagens, adicionar lazy loading

---

## ✅ Checklist de Ação

- [ ] Criar arquivos PHP faltantes (homilia, contatos, sobre, video)
- [ ] Adicionar imagens corretas em `assets/img/`
- [ ] Implementar funcionalidade do menu (JavaScript)
- [ ] Adicionar validações ao fetch da liturgia
- [ ] Testar em mobile e diferentes navegadores
- [ ] Melhorar footer e documentação
- [ ] Otimizar performance (minificar, imagens, etc)
