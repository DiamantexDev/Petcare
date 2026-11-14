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

    // Variáveis do ambiente (ex.: configuradas no Render) têm prioridade sobre o .env
    $system = getenv($key);
    $value = $_ENV[$key] ?? ($system !== false ? $system : null) ?? $vars[$key] ?? null;

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
        'ssl' => filter_var(env('DB_SSL', 'false'), FILTER_VALIDATE_BOOLEAN),
        'ssl_ca' => env('DB_SSL_CA', ''),
    ];
}

function resolveSslCaPath(string $path): string
{
    if ($path === '') {
        return '';
    }

    // Caminhos relativos são resolvidos a partir da raiz do projeto
    if (!preg_match('/^([A-Za-z]:[\\\\\/]|[\\\\\/])/', $path)) {
        $path = dirname(__DIR__, 2) . '/' . $path;
    }

    return $path;
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

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    // Bancos gerenciados (ex.: Aiven) exigem conexão criptografada
    if ($config['ssl']) {
        $caPath = resolveSslCaPath((string) $config['ssl_ca']);

        if ($caPath !== '' && is_file($caPath)) {
            $options[PDO::MYSQL_ATTR_SSL_CA] = $caPath;
            $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = true;
        } else {
            throw new RuntimeException('DB_SSL está ativo, mas o certificado DB_SSL_CA não foi encontrado: ' . $caPath);
        }
    }

    static $pdo = null;

    if ($pdo === null) {
        $pdo = new PDO($dsn, $config['username'], $config['password'], $options);
    }

    return $pdo;
}
