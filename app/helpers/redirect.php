<?php

declare(strict_types=1);

function redirect(string $path): void
{
    $url = $path;
    if (!preg_match('/^(https?:)?\/\//', $url)) {
        $url = '/' . ltrim($url, '/');
    }

    header('Location: ' . $url);
    exit;
}

function redirectWithMessage(string $path, string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    redirect($path);
}

function getFlashMessage(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}
