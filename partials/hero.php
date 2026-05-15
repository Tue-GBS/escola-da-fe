<?php
if (!defined('APP_BOOTSTRAPPED')) {
    header('Location: ../index.php#inicio');
    exit;
}
?>

<section class="hero section" id="inicio">
    <div class="hero__content">
        <p class="eyebrow"><?= e($app['parish']) ?></p>
        <h1>Escola da Fe</h1>
        <p class="hero__lead">
            Um espaco de formacao para estudar a Palavra, compreender a doutrina catolica
            e viver a fe com mais profundidade na comunidade.
        </p>
        <div class="hero__actions">
            <a class="button button--primary" href="#aulas">Ver aulas</a>
            <a class="button button--ghost" href="#contato">Falar conosco</a>
        </div>
    </div>

    <div class="hero__media" aria-label="Imagem institucional da Escola da Fe">
        <img src="<?= asset('img/banner.png') ?>" alt="Banner da Escola da Fe">
    </div>
</section>
