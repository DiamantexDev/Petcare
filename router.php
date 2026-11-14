<?php

declare(strict_types=1);

/**
 * Roteador para o servidor embutido do PHP (php -S).
 *
 * Uso (na raiz do projeto):
 *   php -S localhost:8000 -t public router.php
 *
 * As páginas ficam em public/, mas css/ e assets/ ficam na raiz do projeto
 * (assim como no XAMPP). Este roteador serve esses arquivos estáticos;
 * todo o resto segue o comportamento padrão do php -S.
 */

$path = rawurldecode((string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));

if (!preg_match('#^/(css|assets)/#', $path)) {
    return false;
}

$root = __DIR__;
$file = realpath($root . $path);
$allowedDirs = [realpath($root . '/css'), realpath($root . '/assets')];

$insideAllowedDir = false;
foreach ($allowedDirs as $dir) {
    if ($dir !== false && $file !== false && str_starts_with($file, $dir . DIRECTORY_SEPARATOR)) {
        $insideAllowedDir = true;
        break;
    }
}

if (!$insideAllowedDir || !is_file($file)) {
    http_response_code(404);
    echo 'Arquivo não encontrado.';
    return true;
}

$mimeTypes = [
    'css' => 'text/css; charset=UTF-8',
    'js' => 'application/javascript; charset=UTF-8',
    'png' => 'image/png',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'gif' => 'image/gif',
    'webp' => 'image/webp',
    'svg' => 'image/svg+xml',
    'ico' => 'image/x-icon',
];

$extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
header('Content-Type: ' . ($mimeTypes[$extension] ?? 'application/octet-stream'));
header('Content-Length: ' . filesize($file));
readfile($file);

return true;
