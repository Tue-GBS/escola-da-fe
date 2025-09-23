// Exemplo de código JavaScript
// Você pode colocar isso em um arquivo .js ou dentro de uma tag <script> no seu HTML

// A URL da API
const urlDaApi = 'https://liturgia.up.railway.app/v2/';

// Usamos a função 'fetch' para fazer a requisição
fetch(urlDaApi)
  .then(response => {
    // A API retornará os dados em formato JSON.
    // Esta linha converte a resposta para um objeto JavaScript.
    return response.json();
  })
  .then(dadosDaLiturgia => {
    // Quando a requisição for bem-sucedida, 'dadosDaLiturgia'
    // conterá todos os dados da API que você viu na documentação.

    console.log(dadosDaLiturgia); // Exibe os dados no console do navegador.

    // A partir daqui, vamos para o passo 2.
    // Chamamos uma função para manipular os dados e exibi-los.
    exibirConteudo(dadosDaLiturgia);
  })
  .catch(error => {
    // Se ocorrer algum erro na requisição (ex: falha de conexão),
    // esta parte do código será executada.
    console.error('Erro ao buscar os dados da liturgia:', error);
    // Aqui você pode exibir uma mensagem de erro no site.
  });

function exibirConteudo(liturgia) {
  // Acessamos os elementos HTML pelo ID
  const tituloLiturgia = document.getElementById('titulo-liturgia');
  const dataLiturgia = document.getElementById('data-liturgia');
  const corLiturgia = document.getElementById('cor-liturgia');
  const oracaoColeta = document.getElementById('oracao-coleta');
  
  // E aqui acessamos as leituras, lembrando que podem ser Arrays
  const primeiraLeituraRef = document.getElementById('primeira-leitura-referencia');
  const primeiraLeituraTexto = document.getElementById('primeira-leitura-texto');
  
  // Agora, preenchemos o conteúdo dos elementos com os dados da API
  // A sintaxe para acessar os dados segue a estrutura JSON que você mostrou
  tituloLiturgia.innerText = liturgia.liturgia;
  dataLiturgia.innerText = `Data: ${liturgia.data}`;
  corLiturgia.innerText = `Cor Litúrgica: ${liturgia.cor}`;
  oracaoColeta.innerText = liturgia.oracoes.coleta;
  
  // Para as leituras, como é um Array, pegamos o primeiro item (se existir)
  // E tratamos a possibilidade de existirem diferentes opções (breve, longa, etc.)
  if (liturgia.leituras.primeiraLeitura && liturgia.leituras.primeiraLeitura.length > 0) {
    const leituraPrincipal = liturgia.leituras.primeiraLeitura[0];
    primeiraLeituraRef.innerText = leituraPrincipal.referencia;
    primeiraLeituraTexto.innerText = leituraPrincipal.texto;
  }
}

