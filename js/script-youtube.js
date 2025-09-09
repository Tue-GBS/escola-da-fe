var player;

// Carrega a API do YouTube
function loadYouTubeAPI() {
  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}

// Inicializa o player
function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    height: '360',
    width: '640',
    videoId: '2eKLF7smCVk', // ID do vídeo do seu link
    playerVars: {
      'autoplay': 0,
      'controls': 1,
      'rel': 0,
      'modestbranding': 1
    },
    events: {
      'onReady': onPlayerReady,
      'onStateChange': onPlayerStateChange
    }
  });
}

// Funções de controle
function onPlayerReady(event) {
  console.log("Player pronto!");
}

function onPlayerStateChange(event) {
  if (event.data == YT.PlayerState.ENDED) {
    console.log("Vídeo terminou!");
  }
}

function playVideo() {
  player.playVideo();
}

function pauseVideo() {
  player.pauseVideo();
}

// Carrega a playlist inteira (opcional)
function loadPlaylist() {
  player.loadPlaylist({
    list: 'PLrwanULrWdL4CTgPVBvo-2wxlt-PKtjuF', // ID da playlist do seu link
    listType: 'playlist',
    index: 0 // Começa pelo primeiro vídeo
  });
}

// Carrega a API quando a página abre
window.onload = loadYouTubeAPI;