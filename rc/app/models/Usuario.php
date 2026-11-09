<?php

declare(strict_types=1);

class Usuario
{
    public static function findByEmail(PDO $pdo, string $email): ?array
    {
        $sql = 'SELECT * FROM usuarios WHERE email = :email LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => strtolower(trim($email))]);

        $usuario = $stmt->fetch();
        return $usuario ?: null;
    }

    public static function findById(PDO $pdo, int $id): ?array
    {
        $sql = 'SELECT * FROM usuarios WHERE id = :id LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $usuario = $stmt->fetch();
        return $usuario ?: null;
    }

    public static function create(PDO $pdo, array $dados): int
    {
        $sql = 'INSERT INTO usuarios (nome, email, senha_hash, tipo, cpf, telefone, cargo, status, created_at)
                VALUES (:nome, :email, :senha_hash, :tipo, :cpf, :telefone, :cargo, :status, NOW())';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $dados['nome'],
            ':email' => strtolower(trim((string) $dados['email'])),
            ':senha_hash' => (string) $dados['senha_hash'],
            ':tipo' => $dados['tipo'],
            ':cpf' => $dados['cpf'] ?? null,
            ':telefone' => $dados['telefone'] ?? null,
            ':cargo' => $dados['cargo'] ?? null,
            ':status' => $dados['status'] ?? 'ativo',
        ]);

        return (int) $pdo->lastInsertId();
    }

    public static function all(PDO $pdo): array
    {
        $sql = 'SELECT * FROM usuarios ORDER BY nome ASC';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    public static function update(PDO $pdo, int $id, array $dados): bool
    {
        $sql = 'UPDATE usuarios SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone, cargo = :cargo, updated_at = NOW() WHERE id = :id';
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':nome' => $dados['nome'],
            ':email' => strtolower(trim((string) $dados['email'])),
            ':cpf' => $dados['cpf'] ?? null,
            ':telefone' => $dados['telefone'] ?? null,
            ':cargo' => $dados['cargo'] ?? null,
            ':id' => $id,
        ]);
    }
}
