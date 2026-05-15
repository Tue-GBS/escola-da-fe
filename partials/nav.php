<header class="site-header" data-header>
    <a class="brand" href="<?= url() ?>#inicio" aria-label="Ir para o inicio">
        <img class="brand__logo" src="<?= asset('img/logo.png') ?>" alt="Logo Escola da Fe">
        <span class="brand__text">
            <strong>Escola da Fe</strong>
            <small>Formacao catolica</small>
        </span>
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" data-nav-toggle>
        <span></span>
        <span></span>
        <span></span>
        <span class="sr-only">Abrir menu</span>
    </button>

    <nav class="site-nav" id="site-nav" data-nav>
        <?php foreach ($navItems as $item): ?>
            <a href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a>
        <?php endforeach; ?>
    </nav>
</header>
