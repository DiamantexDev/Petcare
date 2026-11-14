<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/middleware/cliente.php';

ensureClientAccess();

$pdo = getPdo();
$sessionUser = userSession();
$usuario = Usuario::findById($pdo, (int) $sessionUser['id']);
$cliente = Cliente::findByUsuarioId($pdo, (int) $sessionUser['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Usuario::update($pdo, (int) $sessionUser['id'], [
        'nome' => $_POST['nome'] ?? $usuario['nome'],
        'email' => $_POST['email'] ?? $usuario['email'],
        'cpf' => $_POST['cpf'] ?? $usuario['cpf'],
        'telefone' => $_POST['telefone'] ?? $usuario['telefone'],
    ]);

    if ($cliente) {
        Cliente::update($pdo, (int) $cliente['id'], [
            'logradouro' => $_POST['logradouro'] ?? '',
            'numero' => $_POST['numero'] ?? '',
            'bairro' => $_POST['bairro'] ?? '',
            'cidade' => $_POST['cidade'] ?? '',
            'estado' => $_POST['estado'] ?? '',
            'cep' => $_POST['cep'] ?? '',
            'complemento' => $_POST['complemento'] ?? '',
        ]);
    }

    $_SESSION['usuario_nome'] = $_POST['nome'] ?? $usuario['nome'];
    $_SESSION['usuario_email'] = $_POST['email'] ?? $usuario['email'];
    redirect('/cliente/dashboard.php');
}

$titulo = 'PetCare - Perfil';
require_once __DIR__ . '/../../app/views/components/header.php';
?>

<section class="page py-16">
    <div class="container max-w-2xl">
        <h1 class="text-4xl font-bold mb-8 text-blue-900">Editar perfil</h1>

        <div class="bg-white p-8 rounded-lg shadow-xl">
            <form method="POST" action="/cliente/perfil.php" class="space-y-6">
                <div>
                    <label for="nome" class="block text-sm font-medium mb-1">Nome</label>
                    <input type="text" id="nome" name="nome" value="<?= e($usuario['nome']) ?>" required class="form-input">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium mb-1">E-mail</label>
                    <input type="email" id="email" name="email" value="<?= e($usuario['email']) ?>" required class="form-input">
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="cpf" class="block text-sm font-medium mb-1">CPF</label>
                        <input type="text" id="cpf" name="cpf" value="<?= e($usuario['cpf'] ?? '') ?>" class="form-input">
                    </div>
                    <div>
                        <label for="telefone" class="block text-sm font-medium mb-1">Telefone</label>
                        <input type="text" id="telefone" name="telefone" value="<?= e($usuario['telefone'] ?? '') ?>" class="form-input">
                    </div>
                </div>
                <div>
                    <label for="logradouro" class="block text-sm font-medium mb-1">Logradouro</label>
                    <input type="text" id="logradouro" name="logradouro" value="<?= e($cliente['logradouro'] ?? '') ?>" class="form-input">
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="numero" class="block text-sm font-medium mb-1">Número</label>
                        <input type="text" id="numero" name="numero" value="<?= e($cliente['numero'] ?? '') ?>" class="form-input">
                    </div>
                    <div>
                        <label for="bairro" class="block text-sm font-medium mb-1">Bairro</label>
                        <input type="text" id="bairro" name="bairro" value="<?= e($cliente['bairro'] ?? '') ?>" class="form-input">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="cidade" class="block text-sm font-medium mb-1">Cidade</label>
                        <input type="text" id="cidade" name="cidade" value="<?= e($cliente['cidade'] ?? '') ?>" class="form-input">
                    </div>
                    <div>
                        <label for="estado" class="block text-sm font-medium mb-1">Estado</label>
                        <input type="text" id="estado" name="estado" value="<?= e($cliente['estado'] ?? '') ?>" class="form-input">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="cep" class="block text-sm font-medium mb-1">CEP</label>
                        <input type="text" id="cep" name="cep" value="<?= e($cliente['cep'] ?? '') ?>" class="form-input">
                    </div>
                    <div>
                        <label for="complemento" class="block text-sm font-medium mb-1">Complemento</label>
                        <input type="text" id="complemento" name="complemento" value="<?= e($cliente['complemento'] ?? '') ?>" class="form-input">
                    </div>
                </div>
                <button type="submit" class="btn-full">Salvar alterações</button>
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
