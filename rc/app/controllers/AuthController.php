<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

class AuthController
{
    public static function login(PDO $pdo, array $dados): array
    {
        $email = sanitizeEmail($dados['email'] ?? '');
        $senha = (string) ($dados['senha'] ?? '');

        if ($email === '' || $senha === '' || !isValidEmail($email)) {
            throw new InvalidArgumentException('Informe um e-mail e senha válidos.');
        }

        $usuario = Usuario::findByEmail($pdo, $email);
        if (!$usuario || !password_verify($senha, $usuario['senha_hash'])) {
            throw new InvalidArgumentException('E-mail ou senha inválidos.');
        }

        $_SESSION['usuario_id'] = (int) $usuario['id'];
        $_SESSION['usuario_nome'] = (string) $usuario['nome'];
        $_SESSION['usuario_tipo'] = (string) $usuario['tipo'];
        $_SESSION['usuario_email'] = (string) $usuario['email'];
        $_SESSION['usuario_cargo'] = $usuario['cargo'] ?? null;

        return [
            'id' => (int) $usuario['id'],
            'nome' => (string) $usuario['nome'],
            'tipo' => (string) $usuario['tipo'],
            'cargo' => $usuario['cargo'] ?? null,
        ];
    }

    public static function registerClient(PDO $pdo, array $dados): int
    {
        $nome = sanitizeText($dados['nome'] ?? '');
        $email = sanitizeEmail($dados['email'] ?? '');
        $senha = (string) ($dados['senha'] ?? '');
        $cpf = sanitizeText($dados['cpf'] ?? '');
        $telefone = sanitizeText($dados['telefone'] ?? '');

        if ($nome === '' || $email === '' || $senha === '' || !isValidEmail($email) || !isValidCpf($cpf) || !isValidPhone($telefone)) {
            throw new InvalidArgumentException('Dados do cliente inválidos.');
        }

        if (Usuario::findByEmail($pdo, $email)) {
            throw new InvalidArgumentException('E-mail já cadastrado.');
        }

        $usuarioId = Usuario::create($pdo, [
            'nome' => $nome,
            'email' => $email,
            'senha_hash' => password_hash($senha, PASSWORD_DEFAULT),
            'tipo' => 'cliente',
            'cpf' => preg_replace('/\D/', '', $cpf),
            'telefone' => $telefone,
            'cargo' => null,
        ]);

        Cliente::create($pdo, $usuarioId, [
            'logradouro' => sanitizeText($dados['logradouro'] ?? ''),
            'numero' => sanitizeText($dados['numero'] ?? ''),
            'bairro' => sanitizeText($dados['bairro'] ?? ''),
            'cidade' => sanitizeText($dados['cidade'] ?? ''),
            'estado' => sanitizeText($dados['estado'] ?? ''),
            'cep' => sanitizeText($dados['cep'] ?? ''),
            'complemento' => sanitizeText($dados['complemento'] ?? ''),
        ]);

        return $usuarioId;
    }
}
