<?php
if (!defined('APP_BOOTSTRAPPED')) {
    header('Location: ../index.php#contato');
    exit;
}
?>

<section class="section contact" id="contato">
    <div class="contact__content">
        <p class="eyebrow">Contato</p>
        <h2>Quer acompanhar ou apoiar a Escola da Fe?</h2>
        <p>Entre em contato para sugerir temas, organizar encontros ou compartilhar os conteudos com sua comunidade.</p>
    </div>

    <div class="contact__links">
        <?php foreach ($contacts as $contact): ?>
            <a href="<?= e($contact['href']) ?>" target="_blank" rel="noopener noreferrer">
                <span><?= e($contact['label']) ?></span>
                <strong><?= e($contact['value']) ?></strong>
            </a>
        <?php endforeach; ?>
    </div>
</section>
