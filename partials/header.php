<?php
// Detecta automaticamente a pasta base do site
$basePath = rtrim(str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$base_url = ($basePath === '' ? '/' : $basePath . '/');

// expõe também a versão em maiúsculas para compatibilidade
$BASE_URL = $base_url;

// Título da página, se não definido
$title = $title ?? 'Paróquia Nossa Senhora do Perpétuo Socorro';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= $base_url ?>css/style.css">
    <link rel="stylesheet" href="<?= $base_url ?>css/card_adms.css">
    <link rel="stylesheet" href="<?= $base_url ?>css/card.css">
</head>
<body>
    <?php
    // inclui nav.php de forma segura (garante que $base_url exista e o arquivo seja encontrado)
    $base_url = $base_url ?? '/';
    $navFile = __DIR__ . '/nav.php';
    if (file_exists($navFile)) {
        include_once $navFile;
    } else {
        // mensagem discreta para debug (pode remover em produção)
        echo '<!-- WARNING: nav.php não encontrado em ' . htmlspecialchars($navFile) . ' -->';
    }
    ?>