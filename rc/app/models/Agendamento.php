<?php

declare(strict_types=1);

class Agendamento
{
    public static function create(PDO $pdo, array $dados): int
    {
        $sql = 'INSERT INTO agendamentos (cliente_id, pet_id, servico_id, data_hora, status, observacoes, created_at)
                VALUES (:cliente_id, :pet_id, :servico_id, :data_hora, :status, :observacoes, NOW())';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':cliente_id' => (int) $dados['cliente_id'],
            ':pet_id' => (int) $dados['pet_id'],
            ':servico_id' => (int) $dados['servico_id'],
            ':data_hora' => $dados['data_hora'],
            ':status' => $dados['status'] ?? 'pendente',
            ':observacoes' => $dados['observacoes'] ?? null,
        ]);

        return (int) $pdo->lastInsertId();
    }

    public static function forCliente(PDO $pdo, int $clienteId): array
    {
        $sql = 'SELECT a.*, p.nome AS pet_nome, s.nome AS servico_nome
                FROM agendamentos a
                INNER JOIN pets p ON p.id = a.pet_id
                INNER JOIN servicos s ON s.id = a.servico_id
                WHERE a.cliente_id = :cliente_id
                ORDER BY a.data_hora DESC';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':cliente_id' => $clienteId]);
        return $stmt->fetchAll();
    }

    public static function all(PDO $pdo): array
    {
        $sql = 'SELECT a.*, u.nome AS cliente_nome, p.nome AS pet_nome, s.nome AS servico_nome
                FROM agendamentos a
                INNER JOIN clientes c ON c.id = a.cliente_id
                INNER JOIN usuarios u ON u.id = c.usuario_id
                INNER JOIN pets p ON p.id = a.pet_id
                INNER JOIN servicos s ON s.id = a.servico_id
                ORDER BY a.data_hora DESC';

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}
