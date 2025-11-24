<?php
// Determina o base_url do projeto (independente de qual arquivo incluir o header)
$docRoot = realpath($_SERVER['DOCUMENT_ROOT']);
$projectRoot = realpath(__DIR__ . '/..'); // pasta do projeto (um nível acima de partials)
$rel = str_replace('\\', '/', str_replace($docRoot, '', $projectRoot));
$rel = '/' . trim($rel, '/') . '/';
$base_url = ($rel === '//') ? '/' : $rel;

// expõe também a versão em maiúsculas para compatibilidade
$BASE_URL = $base_url;

// Título da página, se não definido
$title = $title ?? 'Paróquia Nossa Senhora do Perpétuo Socorro';

// Função helper: resolve um caminho público verificando onde o arquivo existe no servidor
function resolve_path(string $relative): string {
    global $base_url;
    $candidates = [
        $relative,
        'partials/'.$relative,
        'html/'.$relative,
        'oracoes/'.$relative,
        'agenda/'.$relative,
        'liturgia/'.$relative,
        'assets/'.$relative,
    ];

    $docRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/\\');

    foreach ($candidates as $rel) {
        // monta caminho de arquivo no servidor
        $serverPath = $docRoot . str_replace('/', DIRECTORY_SEPARATOR, $base_url . $rel);
        if (file_exists($serverPath)) {
            // retorna URL relativa correta (base_url já tem / no início e fim)
            return $base_url . $rel;
        }
    }

    // fallback: mantém como '#' para evitar 404
    return '#';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title) ?></title>

    <!-- usar resolve_path para garantir que o CSS seja encontrado em qualquer página -->
    <link rel="stylesheet" href="<?= resolve_path('css/main.css') ?>">
</head>
<body>
    <!-- Navbar incorporada -->
    <nav class="menu">
        <!-- Item do Menu Principal -->
        <div class="menu-item has-submenu">
            <button class="menu-toggle" aria-expanded="false" aria-controls="main-submenu">
                <span class="icon-menu"></span>Menu
            </button>
            <ul id="main-submenu" class="submenu">
                <li><a href="<?= resolve_path('index.php') ?>">Início</a></li>
                <li><a href="<?= resolve_path('contatos.php') ?>">Contatos</a></li>
                <li><a href="<?= resolve_path('sobre.php') ?>">Sobre</a></li>
            </ul>
        </div>

        <div class="logo-menu">
            <a href="<?= resolve_path('index.php') ?>" class="logo-link">
                <img src="<?= resolve_path('assets/img/logo.png') ?>" alt="Logo do Site" class="logo-image">
            </a>
        </div>

        <!-- Item Liturgia -->
        <div class="menu-item has-submenu">
            <button class="menu-label" aria-expanded="false" aria-controls="liturgia-submenu">Liturgia</button>
            <ul id="liturgia-submenu" class="submenu">
                <li><a href="<?= resolve_path('homilia.php') ?>">Homilia diária</a></li>
                <li><a href="#">Santo do dia</a></li>
                <li><a href="#">Versículo do dia</a></li>
            </ul>
        </div>

        <!-- Item Catequese -->
        <div class="menu-item has-submenu">
            <button class="menu-label" aria-expanded="false" aria-controls="catequese-submenu">Catequese</button>
            <ul id="catequese-submenu" class="submenu">
                <li><a href="<?= resolve_path('video.php') ?>">Vídeos Aulas</a></li>
            </ul>
        </div>

        <!-- Item Busca -->
        <div class="menu-item search-item">
            <button class="menu-toggle" aria-label="Abrir busca">
                <span class="icon-search"></span>Busca
            </button>
        </div>
    </nav>