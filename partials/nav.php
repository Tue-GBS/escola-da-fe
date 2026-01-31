<?php
// partials/nav.php - Menu principal
// Nota: $base_url é definido em header.php e está disponível globalmente
?>
<nav class="menu">
    <!-- Item do Menu Principal -->
    <div class="menu-item has-submenu">
        <button class="menu-toggle" aria-expanded="false" aria-controls="main-submenu">
            <span class="icon-menu"></span>Menu
        </button>
        <ul id="main-submenu" class="submenu">
            <li><a href="<?= $base_url ?>index.php">Início</a></li>
            <li><a href="<?= $base_url ?>partials/contatos.php">Contatos</a></li>
            <li><a href="<?= $base_url ?>partials/sobre.php">Sobre</a></li>
        </ul>
    </div>

    <div class="logo-menu">
        <a href="<?= $base_url ?>index.php" class="logo-link">
            <img src="<?= $base_url ?>assets/img/logo.png" alt="Logo do Site" class="logo-image">
        </a>
    </div>

    <!-- Item Liturgia -->
    <div class="menu-item has-submenu">
        <button class="menu-label" aria-expanded="false" aria-controls="liturgia-submenu">Liturgia</button>
        <ul id="liturgia-submenu" class="submenu">
            <li><a href="<?= $base_url ?>partials/homilia.php">Homilia diária</a></li>
            <li><a href="#">Santo do dia</a></li>
            <li><a href="#">Versículo do dia</a></li>
        </ul>
    </div>

    <!-- Item Catequese -->
    <div class="menu-item has-submenu">
        <button class="menu-label" aria-expanded="false" aria-controls="catequese-submenu">Catequese</button>
        <ul id="catequese-submenu" class="submenu">
            <li><a href="<?= $base_url ?>partials/video.php">Vídeos Aulas</a></li>
            <li><a href="#">E-books</a></li>
            <li><a href="#">Dúvidas</a></li>
        </ul>
    </div>

    <!-- Item Orações -->
    <div class="menu-item has-submenu">
        <button class="menu-label" aria-expanded="false" aria-controls="oracoes-submenu">Orações</button>
        <ul id="oracoes-submenu" class="submenu">
            <li><a href="<?= $base_url ?>oracoes/comuns.html">Comuns</a></li>
            <li><a href="#">Terços Diversos</a></li>
            <li><a href="#">Rosário N. Senhora</a></li>
        </ul>
    </div>

    <!-- Item Agenda -->
    <div class="menu-item has-submenu">
        <button class="menu-label" aria-expanded="false" aria-controls="agenda-submenu">Agenda</button>
        <ul id="agenda-submenu" class="submenu">
            <li><a href="<?= $base_url ?>agenda/missas.html">Missas</a></li>
            <li><a href="#">Confissões</a></li>
            <li><a href="#">Eventos</a></li>
        </ul>
    </div>

    <!-- Item Busca -->
    <div class="menu-item search-item">
        <button class="menu-toggle" aria-label="Abrir busca">
            <span class="icon-search"></span>Busca
        </button>
    </div>
</nav>
