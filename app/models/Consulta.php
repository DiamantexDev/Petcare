<?php

declare(strict_types=1);

class Consulta
{
    public static function create(PDO $pdo, array $dados): int
    {
        $sql = 'INSERT INTO consultas (pet_id, funcionario_id, servico_id, data_hora, diagnostico, observacoes, status, created_at)
                VALUES (:pet_id, :funcionario_id, :servico_id, :data_hora, :diagnostico, :observacoes, :status, NOW())';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':pet_id' => (int) $dados['pet_id'],
            ':funcionario_id' => $dados['funcionario_id'] ?? null,
            ':servico_id' => $dados['servico_id'] ?? null,
            ':data_hora' => $dados['data_hora'],
            ':diagnostico' => $dados['diagnostico'] ?? null,
            ':observacoes' => $dados['observacoes'] ?? null,
            ':status' => $dados['status'] ?? 'agendada',
        ]);

        return (int) $pdo->lastInsertId();
    }

    public static function all(PDO $pdo): array
    {
        $sql = 'SELECT c.*, p.nome AS pet_nome, u.nome AS funcionario_nome, s.nome AS servico_nome
                FROM consultas c
                LEFT JOIN pets p ON p.id = c.pet_id
                LEFT JOIN funcionarios f ON f.id = c.funcionario_id
                LEFT JOIN usuarios u ON u.id = f.usuario_id
                LEFT JOIN servicos s ON s.id = c.servico_id
                ORDER BY c.data_hora DESC';

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}
