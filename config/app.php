<?php
declare(strict_types=1);

const APP_BOOTSTRAPPED = true;

$app = [
    'name' => 'Escola da Fe',
    'tagline' => 'Formacao catolica simples, profunda e acessivel.',
    'parish' => 'Paroquia Nossa Senhora do Perpetuo Socorro',
];

function env_value(string $key, ?string $default = null): ?string
{
    $value = getenv($key);
    return ($value === false || trim($value) === '') ? $default : $value;
}

function base_url(): string
{
    static $baseUrl = null;

    if ($baseUrl !== null) {
        return $baseUrl;
    }

    $configured = env_value('BASE_URL', '/');
    $baseUrl = rtrim($configured, '/') . '/';

    return $baseUrl === '//' ? '/' : $baseUrl;
}

function url(string $path = ''): string
{
    return base_url() . ltrim($path, '/');
}

function asset(string $path): string
{
    return url('assets/' . ltrim($path, '/'));
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
