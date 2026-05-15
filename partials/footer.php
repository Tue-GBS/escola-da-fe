    <footer class="site-footer">
        <div>
            <strong>Escola da Fe</strong>
            <p><?= e($app['tagline']) ?></p>
        </div>
        <nav aria-label="Links do rodape">
            <?php foreach ($navItems as $item): ?>
                <a href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a>
            <?php endforeach; ?>
        </nav>
        <p class="site-footer__copy">Projeto institucional desenvolvido para estudo, evangelizacao e apresentacao academica.</p>
    </footer>
    <script src="<?= asset('js/script.js') ?>"></script>
</body>
</html>
