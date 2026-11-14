<?php

declare(strict_types=1);

/**
 * Importa database.sql no banco configurado no .env.
 * Uso: php database/import.php
 *
 * As linhas CREATE DATABASE / USE são ignoradas, pois bancos gerenciados
 * (ex.: Aiven) já fornecem um banco pronto (DB_NAME).
 *
 * O script pode ser executado mais de uma vez: as tabelas usam
 * CREATE TABLE IF NOT EXISTS e os dados de exemplo só são inseridos
 * se ainda não existirem.
 */

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit('Somente via linha de comando.');
}

require_once __DIR__ . '/../app/config/database.php';

$sql = file_get_contents(__DIR__ . '/database.sql');
if ($sql === false) {
    fwrite(STDERR, "Não foi possível ler database.sql\n");
    exit(1);
}

$sql = preg_replace('/^\s*(CREATE DATABASE|USE)\b[^;]*;\s*$/mi', '', $sql);
$statements = array_filter(array_map('trim', explode(';', $sql)));

try {
    $pdo = getPdo();
} catch (Throwable $e) {
    fwrite(STDERR, 'Falha na conexão: ' . $e->getMessage() . "\n");
    exit(1);
}

foreach ($statements as $statement) {
    $pdo->exec($statement);
    $first = strtok($statement, "\n");
    echo 'OK: ' . substr($first, 0, 70) . "\n";
}

echo "\nImportação concluída.\n";
