<?php

declare(strict_types=1);

class Servico
{
    public static function create(PDO $pdo, array $dados): int
    {
        $sql = 'INSERT INTO servicos (nome, descricao, preco, duracao_minutos, ativo, created_at)
                VALUES (:nome, :descricao, :preco, :duracao_minutos, :ativo, NOW())';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $dados['nome'],
            ':descricao' => $dados['descricao'],
            ':preco' => (float) $dados['preco'],
            ':duracao_minutos' => (int) ($dados['duracao_minutos'] ?? 60),
            ':ativo' => (int) ($dados['ativo'] ?? 1),
        ]);

        return (int) $pdo->lastInsertId();
    }

    public static function all(PDO $pdo): array
    {
        $sql = 'SELECT * FROM servicos WHERE ativo = 1 ORDER BY nome ASC';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}
