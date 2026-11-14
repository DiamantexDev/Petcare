<?php

declare(strict_types=1);

class Pet
{
    public static function create(PDO $pdo, array $dados): int
    {
        $sql = 'INSERT INTO pets (cliente_id, nome, tipo, raca, idade, peso, observacoes, created_at)
                VALUES (:cliente_id, :nome, :tipo, :raca, :idade, :peso, :observacoes, NOW())';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':cliente_id' => (int) $dados['cliente_id'],
            ':nome' => $dados['nome'],
            ':tipo' => $dados['tipo'],
            ':raca' => $dados['raca'] ?? null,
            ':idade' => $dados['idade'] ?? null,
            ':peso' => $dados['peso'] ?? null,
            ':observacoes' => $dados['observacoes'] ?? null,
        ]);

        return (int) $pdo->lastInsertId();
    }

    public static function forClient(PDO $pdo, int $clienteId): array
    {
        $sql = 'SELECT * FROM pets WHERE cliente_id = :cliente_id ORDER BY nome ASC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':cliente_id' => $clienteId]);
        return $stmt->fetchAll();
    }

    public static function all(PDO $pdo): array
    {
        $sql = 'SELECT p.*, c.usuario_id, u.nome AS dono FROM pets p INNER JOIN clientes c ON c.id = p.cliente_id INNER JOIN usuarios u ON u.id = c.usuario_id ORDER BY p.nome ASC';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}
