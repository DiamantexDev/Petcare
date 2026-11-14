<?php

declare(strict_types=1);

function petcarePublicBaseUrl(): string
{
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
    $segments = array_values(array_filter(explode('/', $scriptName), static fn (string $segment): bool => $segment !== ''));
    $publicIndex = array_search('public', $segments, true);

    if ($publicIndex !== false) {
        $baseSegments = array_slice($segments, 0, $publicIndex + 1);
        return '/' . implode('/', $baseSegments);
    }

    return '/';
}

function petcareProjectBaseUrl(): string
{
    $publicBase = petcarePublicBaseUrl();

    if ($publicBase === '/') {
        return '/';
    }

    return preg_replace('#/public$#', '', $publicBase) ?: '/';
}

function petcarePageUrl(string $path = ''): string
{
    $base = petcarePublicBaseUrl();
    $relativePath = trim((string) $path, '/');

    if ($relativePath === '') {
        return $base === '/' ? '/' : rtrim($base, '/');
    }

    return $base === '/' ? '/' . $relativePath : rtrim($base, '/') . '/' . $relativePath;
}

function petcareAssetUrl(string $path = ''): string
{
    $base = petcareProjectBaseUrl();
    $relativePath = trim((string) $path, '/');

    if ($relativePath === '') {
        return $base === '/' ? '/' : rtrim($base, '/');
    }

    return $base === '/' ? '/' . $relativePath : rtrim($base, '/') . '/' . $relativePath;
}
