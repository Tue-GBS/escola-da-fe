<?php
declare(strict_types=1);

require __DIR__ . '/../config/app.php';
require __DIR__ . '/../config/content.php';

$title = 'Homilia diaria | Escola da Fe';

include __DIR__ . '/header.php';
?>

<main>
    <section class="section page-section">
        <div class="section__intro">
            <p class="eyebrow">Liturgia</p>
            <h1>Homilia diaria</h1>
            <p>Esta area esta preparada para receber futuramente uma integracao de liturgia ou textos pastorais revisados.</p>
        </div>
        <a class="button button--primary" href="<?= url() ?>#inicio">Voltar ao inicio</a>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>
