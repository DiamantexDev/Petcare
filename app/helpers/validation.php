<?php

declare(strict_types=1);

function sanitizeText(?string $value): string
{
    return trim((string) ($value ?? ''));
}

function sanitizeEmail(?string $value): string
{
    return strtolower(trim((string) ($value ?? '')));
}

function isValidEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function isValidCpf(string $cpf): bool
{
    $cpf = preg_replace('/\D/', '', $cpf ?? '');

    if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }

    $sum = 0;
    for ($i = 0; $i < 9; $i++) {
        $sum += ((int) $cpf[$i]) * (10 - $i);
    }

    $digit1 = 11 - ($sum % 11);
    $digit1 = $digit1 >= 10 ? 0 : $digit1;

    if (((int) $cpf[9]) !== $digit1) {
        return false;
    }

    $sum = 0;
    for ($i = 0; $i < 10; $i++) {
        $sum += ((int) $cpf[$i]) * (11 - $i);
    }

    $digit2 = 11 - ($sum % 11);
    $digit2 = $digit2 >= 10 ? 0 : $digit2;

    return ((int) $cpf[10]) === $digit2;
}

function isValidPhone(string $phone): bool
{
    return preg_match('/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/', $phone) === 1;
}

function e(string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
