<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/middleware/cliente.php';

ensureClientAccess();

$pdo = getPdo();
$usuario = userSession();
$cliente = Cliente::findByUsuarioId($pdo, (int) $usuario['id']);
$pets = $cliente ? Pet::forClient($pdo, (int) $cliente['id']) : [];
$agendamentos = $cliente ? Agendamento::forCliente($pdo, (int) $cliente['id']) : [];

$titulo = 'PetCare - Minha conta';
require_once __DIR__ . '/../../app/views/components/header.php';
?>

<section class="page py-16">
    <div class="container">
        <h1 class="text-4xl font-bold mb-8 text-blue-900">Minha conta</h1>

        <div class="grid md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <p class="text-sm text-blue-700 uppercase">Pets cadastrados</p>
                <p class="text-3xl font-bold text-blue-900"><?= count($pets) ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <p class="text-sm text-blue-700 uppercase">Agendamentos</p>
                <p class="text-3xl font-bold text-blue-900"><?= count($agendamentos) ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <p class="text-sm text-blue-700 uppercase">Usuário</p>
                <p class="text-xl font-bold text-blue-900"><?= e($usuario['nome']) ?></p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Dados pessoais</h2>
                <p><strong>Nome:</strong> <?= e($usuario['nome']) ?></p>
                <p><strong>E-mail:</strong> <?= e($usuario['email']) ?></p>
                <p><strong>Tipo:</strong> <?= e($usuario['tipo']) ?></p>
                <a href="/cliente/perfil.php" class="btn btn-primary mt-5">Editar perfil</a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Ações rápidas</h2>
                <div class="space-y-3">
                    <a href="/cliente/cadastro-pet.php" class="btn btn-full text-center">Cadastrar pet</a>
                    <a href="/cliente/agendamentos.php" class="btn btn-full text-center">Ver agendamentos</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
