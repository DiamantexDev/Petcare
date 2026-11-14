<?php

declare(strict_types=1);

class ServicoController
{
    public static function store(PDO $pdo, array $dados): int
    {
        if (empty($dados['nome']) || empty($dados['descricao']) || empty($dados['preco'])) {
            throw new InvalidArgumentException('Nome, descrição e preço são obrigatórios.');
        }

        return Servico::create($pdo, [
            'nome' => sanitizeText($dados['nome']),
            'descricao' => sanitizeText($dados['descricao']),
            'preco' => $dados['preco'],
            'duracao_minutos' => (int) ($dados['duracao_minutos'] ?? 60),
            'ativo' => 1,
        ]);
    }
}
