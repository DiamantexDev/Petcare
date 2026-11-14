<?php

declare(strict_types=1);

class ConsultaController
{
    public static function store(PDO $pdo, array $dados): int
    {
        if (empty($dados['pet_id']) || empty($dados['data_hora'])) {
            throw new InvalidArgumentException('Pet e data são obrigatórios para agendar uma consulta.');
        }

        return Consulta::create($pdo, [
            'pet_id' => (int) $dados['pet_id'],
            'funcionario_id' => $dados['funcionario_id'] ?? null,
            'servico_id' => $dados['servico_id'] ?? null,
            'data_hora' => $dados['data_hora'],
            'diagnostico' => $dados['diagnostico'] ?? null,
            'observacoes' => $dados['observacoes'] ?? null,
            'status' => $dados['status'] ?? 'agendada',
        ]);
    }
}
