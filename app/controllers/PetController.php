<?php

declare(strict_types=1);

class PetController
{
    public static function store(PDO $pdo, int $usuarioId, array $dados): int
    {
        $cliente = Cliente::findByUsuarioId($pdo, $usuarioId);
        if (!$cliente) {
            throw new InvalidArgumentException('Cliente não encontrado.');
        }

        return Pet::create($pdo, [
            'cliente_id' => (int) $cliente['id'],
            'nome' => sanitizeText($dados['nome'] ?? ''),
            'tipo' => sanitizeText($dados['tipo'] ?? ''),
            'raca' => sanitizeText($dados['raca'] ?? ''),
            'idade' => sanitizeText($dados['idade'] ?? ''),
            'peso' => sanitizeText($dados['peso'] ?? ''),
            'observacoes' => sanitizeText($dados['observacoes'] ?? ''),
        ]);
    }
}
