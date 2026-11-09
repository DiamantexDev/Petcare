<?php

declare(strict_types=1);

function env(string $key, mixed $default = null): mixed
{
    $envFile = dirname(__DIR__, 2) . '/.env';

    static $vars = null;

    if ($vars === null) {
        $vars = [];

        if (is_file($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (preg_match('/^\s*[#;]/', $line)) {
                    continue;
                }

                [$name, $value] = array_pad(explode('=', $line, 2), 2, '');
                $name = trim($name);
                $value = trim($value);

                if ($name === '') {
                    continue;
                }

                $vars[$name] = trim($value, " \t\n\r\0\x0B\"'");
            }
        }
    }

    $value = $_ENV[$key] ?? $vars[$key] ?? null;

    return $value !== null ? $value : $default;
}

function getDatabaseConfig(): array
{
    return [
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_NAME', 'petshop'),
        'username' => env('DB_USER', 'root'),
        'password' => env('DB_PASSWORD', ''),
    ];
}

function getPdo(): PDO
{
    $config = getDatabaseConfig();

    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        $config['host'],
        $config['port'],
        $config['database']
    );

    $pdo = new PDO(
        $dsn,
        $config['username'],
        $config['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    return $pdo;
}
