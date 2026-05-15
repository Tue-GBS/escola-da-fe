<?php
if (!defined('APP_BOOTSTRAPPED')) {
    header('Location: ../index.php#beneficios');
    exit;
}
?>

<section class="section benefits" id="beneficios">
    <div class="section__intro">
        <p class="eyebrow">Diferenciais</p>
        <h2>Uma base simples para comunicar melhor e evoluir com seguranca.</h2>
    </div>

    <div class="benefit-grid">
        <?php foreach ($benefits as $benefit): ?>
            <article class="benefit-card">
                <span class="benefit-card__icon" aria-hidden="true"></span>
                <h3><?= e($benefit['title']) ?></h3>
                <p><?= e($benefit['description']) ?></p>
            </article>
        <?php endforeach; ?>
    </div>
</section>
