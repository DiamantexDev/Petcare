<?php

declare(strict_types=1);

class ClienteController
{
    public static function dashboard(PDO $pdo, int $usuarioId): array
    {
        $usuario = Usuario::findById($pdo, $usuarioId);
        $cliente = Cliente::findByUsuarioId($pdo, $usuarioId);
        $pets = Pet::forClient($pdo, (int) $cliente['id']);
        $agendamentos = Agendamento::forCliente($pdo, (int) $cliente['id']);

        return [
            'usuario' => $usuario,
            'cliente' => $cliente,
            'pets' => $pets,
            'agendamentos' => $agendamentos,
        ];
    }
}
