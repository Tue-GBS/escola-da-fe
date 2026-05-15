<?php
declare(strict_types=1);

require __DIR__ . '/config/app.php';
require __DIR__ . '/config/content.php';

$title = 'Escola da Fe | Formacao catolica';

include __DIR__ . '/partials/header.php';
?>

<main>
    <?php include __DIR__ . '/partials/hero.php'; ?>
    <?php include __DIR__ . '/partials/sobre.php'; ?>
    <?php include __DIR__ . '/partials/video.php'; ?>
    <?php include __DIR__ . '/partials/beneficios.php'; ?>
    <?php include __DIR__ . '/partials/contatos.php'; ?>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
