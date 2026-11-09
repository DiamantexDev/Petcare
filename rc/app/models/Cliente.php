<?php

declare(strict_types=1);

class Cliente
{
    public static function create(PDO $pdo, int $usuarioId, array $dados): int
    {
        $sql = 'INSERT INTO clientes (usuario_id, logradouro, numero, bairro, cidade, estado, cep, complemento, created_at)
                VALUES (:usuario_id, :logradouro, :numero, :bairro, :cidade, :estado, :cep, :complemento, NOW())';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':logradouro' => $dados['logradouro'],
            ':numero' => $dados['numero'],
            ':bairro' => $dados['bairro'],
            ':cidade' => $dados['cidade'],
            ':estado' => $dados['estado'],
            ':cep' => $dados['cep'],
            ':complemento' => $dados['complemento'] ?? null,
        ]);

        return (int) $pdo->lastInsertId();
    }

    public static function findByUsuarioId(PDO $pdo, int $usuarioId): ?array
    {
        $sql = 'SELECT * FROM clientes WHERE usuario_id = :usuario_id LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId]);
        return $stmt->fetch() ?: null;
    }

    public static function all(PDO $pdo): array
    {
        $sql = 'SELECT c.*, u.nome, u.email, u.telefone, u.cpf FROM clientes c INNER JOIN usuarios u ON u.id = c.usuario_id ORDER BY u.nome ASC';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    public static function update(PDO $pdo, int $clienteId, array $dados): bool
    {
        $sql = 'UPDATE clientes SET logradouro = :logradouro, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep, complemento = :complemento, updated_at = NOW() WHERE id = :id';
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':logradouro' => $dados['logradouro'],
            ':numero' => $dados['numero'],
            ':bairro' => $dados['bairro'],
            ':cidade' => $dados['cidade'],
            ':estado' => $dados['estado'],
            ':cep' => $dados['cep'],
            ':complemento' => $dados['complemento'] ?? null,
            ':id' => $clienteId,
        ]);
    }
}
