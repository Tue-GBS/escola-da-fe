<?php
$title = $title ?? 'Escola da Fe';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Escola da Fe: formacao catolica, estudos biblicos, aulas e conteudos para aprofundar a vida crista.">
    <title><?= e($title) ?></title>
    <link rel="icon" href="<?= asset('img/logo.png') ?>">
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">
</head>
<body>
    <?php include __DIR__ . '/nav.php'; ?>
