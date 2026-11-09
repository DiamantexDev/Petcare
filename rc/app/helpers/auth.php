<?php

declare(strict_types=1);

function userSession(): ?array
{
    if (empty($_SESSION['usuario_id'])) {
        return null;
    }

    return [
        'id' => (int) $_SESSION['usuario_id'],
        'nome' => (string) $_SESSION['usuario_nome'],
        'tipo' => (string) $_SESSION['usuario_tipo'],
        'email' => $_SESSION['usuario_email'] ?? '',
        'cargo' => $_SESSION['usuario_cargo'] ?? null,
    ];
}

function isAuthenticated(): bool
{
    return !empty($_SESSION['usuario_id']);
}

function userIsClient(): bool
{
    return isAuthenticated() && ($_SESSION['usuario_tipo'] ?? '') === 'cliente';
}

function userIsFuncionario(): bool
{
    return isAuthenticated() && ($_SESSION['usuario_tipo'] ?? '') === 'funcionario';
}

function requireAuth(): void
{
    if (!isAuthenticated()) {
        redirect('/login.php');
    }
}

function requireRole(string $role): void
{
    requireAuth();

    if (($_SESSION['usuario_tipo'] ?? '') !== $role) {
        redirect('/403.php');
    }
}

function requireAnyRole(array $roles): void
{
    requireAuth();

    if (!in_array($_SESSION['usuario_tipo'] ?? '', $roles, true)) {
        redirect('/403.php');
    }
}

function logoutUser(): void
{
    $_SESSION = [];
    session_destroy();
}
