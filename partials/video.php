<?php
if (!defined('APP_BOOTSTRAPPED')) {
    header('Location: ../index.php#aulas');
    exit;
}
?>

<section class="section lessons" id="aulas">
    <div class="section__intro">
        <p class="eyebrow">Aulas e conteudos</p>
        <h2>Videos e trilhas de estudo para aprofundar a caminhada.</h2>
        <p>Os videos ficam cadastrados em <code>config/content.php</code>, facilitando a manutencao sem mexer no layout.</p>
    </div>

    <div class="video-grid">
        <?php foreach ($videos as $video): ?>
            <article class="video-card">
                <div class="video-card__frame">
                    <iframe
                        src="https://www.youtube-nocookie.com/embed/<?= e($video['youtube_id']) ?>?rel=0"
                        title="<?= e($video['title']) ?>"
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="video-card__body">
                    <h3><?= e($video['title']) ?></h3>
                    <p><?= e($video['description']) ?></p>
                    <a class="text-link" href="https://www.youtube.com/watch?v=<?= e($video['youtube_id']) ?>" target="_blank" rel="noopener noreferrer">Assistir no YouTube</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <div class="lesson-grid" aria-label="Outros conteudos">
        <?php foreach ($lessons as $lesson): ?>
            <article class="lesson-card">
                <h3><?= e($lesson['title']) ?></h3>
                <p><?= e($lesson['description']) ?></p>
            </article>
        <?php endforeach; ?>
    </div>
</section>
