<?php
// catequese/videos.php

// título da página
$title = 'Vídeos Aulas — Escola da Fé';

// inclui o layout (header + nav + abertura do <main>)
include __DIR__ . '/../partials/header.php';


// lista de vídeos (aqui você cadastra os vídeos do YouTube)
$videos = [
    [
        'id' => 'J9J4QeuAuZo', // ID do vídeo 1
        'titulo' => 'Suic*dio do Pe. Geraldo de Oliveira',
        'descricao' => '',
    ],
    [
        'id' => 'DEF456uvw', // ID do vídeo 2
        'titulo' => 'Aula 2 — O que é a Liturgia?',
        'descricao' => 'Entenda o sentido da liturgia na vida da Igreja.',
    ],
    [
        'id' => 'GHI789rst', // ID do vídeo 3
        'titulo' => 'Aula 3 — Sacramento da Eucaristia',
        'descricao' => 'Reflexão sobre a presença real de Cristo na Eucaristia.',
    ],
];
?>

<main>

    <h1>Vídeos Aulas</h1>
     <p>Seleção de vídeos da Escola da Fé para estudo e aprofundamento.</p>

    <?php foreach ($videos as $video): 

        // Lista os videos acima
        
    ?>
    <article class="video-card">
        <h2><?= htmlspecialchars($video['titulo']) ?></h2>
        <p><?= htmlspecialchars($video['descricao']) ?></p>

        <div class="video-wrapper">
        <iframe
            src="https://www.youtube-nocookie.com/embed/<?= htmlspecialchars($video['id']) ?>?rel=0"
            title="<?= htmlspecialchars($video['titulo']) ?>"
            loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share">
        </iframe>
        </div>
    </article>
  </main>
<?php endforeach; ?>

<?php
include __DIR__ . '/../partials/footer.php';
?>
