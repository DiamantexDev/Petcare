<?php

declare(strict_types=1);

class FuncionarioController
{
    public static function dashboard(PDO $pdo): array
    {
        return [
            'clientes' => Cliente::all($pdo),
            'funcionarios' => Funcionario::all($pdo),
            'pets' => Pet::all($pdo),
            'servicos' => Servico::all($pdo),
            'consultas' => Consulta::all($pdo),
            'agendamentos' => Agendamento::all($pdo),
        ];
    }
}
