<?php

declare(strict_types=1);

class Funcionario
{
    public static function create(PDO $pdo, int $usuarioId, array $dados): int
    {
        $sql = 'INSERT INTO funcionarios (usuario_id, cargo, especialidade, created_at) VALUES (:usuario_id, :cargo, :especialidade, NOW())';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':cargo' => $dados['cargo'] ?? 'Funcionario',
            ':especialidade' => $dados['especialidade'] ?? null,
        ]);

        return (int) $pdo->lastInsertId();
    }

    public static function all(PDO $pdo): array
    {
        $sql = 'SELECT f.*, u.nome, u.email, u.telefone, u.cpf FROM funcionarios f INNER JOIN usuarios u ON u.id = f.usuario_id ORDER BY u.nome ASC';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    public static function findByUsuarioId(PDO $pdo, int $usuarioId): ?array
    {
        $sql = 'SELECT * FROM funcionarios WHERE usuario_id = :usuario_id LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId]);
        return $stmt->fetch() ?: null;
    }
}
