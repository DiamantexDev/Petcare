<?php

declare(strict_types=1);

class AgendamentoController
{
    public static function store(PDO $pdo, array $dados): int
    {
        if (empty($dados['pet_id']) || empty($dados['servico_id']) || empty($dados['data_hora'])) {
            throw new InvalidArgumentException('Pet, serviço e data são obrigatórios.');
        }

        return Agendamento::create($pdo, [
            'cliente_id' => (int) $dados['cliente_id'],
            'pet_id' => (int) $dados['pet_id'],
            'servico_id' => (int) $dados['servico_id'],
            'data_hora' => $dados['data_hora'],
            'observacoes' => $dados['observacoes'] ?? null,
            'status' => $dados['status'] ?? 'pendente',
        ]);
    }
}
