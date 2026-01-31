<?php
// Determina o base_url do projeto (independente de qual arquivo incluir o header)
$docRoot = realpath($_SERVER['DOCUMENT_ROOT']);
$projectRoot = realpath(__DIR__ . '/..'); // pasta do projeto (um nível acima de partials)
$rel = str_replace('\\', '/', str_replace($docRoot, '', $projectRoot));
$rel = '/' . trim($rel, '/') . '/';
$base_url = ($rel === '//') ? '/' : $rel;

// expõe também a versão em maiúsculas para compatibilidade
$BASE_URL = $base_url;

// Permite sobrescrita por variável de ambiente `BASE_URL` (útil em contêineres)
$envBase = getenv('BASE_URL');
if ($envBase !== false && trim($envBase) !== '') {
    // normaliza: mantém barra final
    $envBase = rtrim($envBase, '/') . '/';
    $base_url = $envBase;
    $BASE_URL = $base_url;
}

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

// Função helper: monta URL segura para assets
function asset_url(string $path): string {
    global $base_url;
    // limpa barras extras no início
    $path = ltrim($path, '/');
    return $base_url . $path;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title) ?></title>

    <!-- usar $base_url para garantir CSS funcione em qualquer contexto (localhost, domínio, subpasta) -->
    <link rel="stylesheet" href="<?= $base_url ?>css/main.css">
</head>
<body>
    <!-- Menu removido daqui - agora em nav.php separado -->
    <?php include __DIR__ . '/nav.php'; ?>