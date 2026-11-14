<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/middleware/funcionario.php';

ensureFuncionarioAccess();

$pdo = getPdo();
$dados = FuncionarioController::dashboard($pdo);

$titulo = 'PetCare - Dashboard do funcionário';
require_once __DIR__ . '/../../app/views/components/header.php';
?>

<section class="page py-16">
    <div class="container">
        <h1 class="text-4xl font-bold text-blue-900 mb-8">Dashboard do funcionário</h1>

        <div class="grid md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <p class="text-sm uppercase text-blue-700">Clientes</p>
                <p class="text-3xl font-bold text-blue-900"><?= count($dados['clientes']) ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <p class="text-sm uppercase text-blue-700">Funcionários</p>
                <p class="text-3xl font-bold text-blue-900"><?= count($dados['funcionarios']) ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <p class="text-sm uppercase text-blue-700">Pets</p>
                <p class="text-3xl font-bold text-blue-900"><?= count($dados['pets']) ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <p class="text-sm uppercase text-blue-700">Serviços</p>
                <p class="text-3xl font-bold text-blue-900"><?= count($dados['servicos']) ?></p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Consultas agendadas</h2>
                <p class="text-lg text-blue-800"><?= count($dados['consultas']) ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Agendamentos</h2>
                <p class="text-lg text-blue-800"><?= count($dados['agendamentos']) ?></p>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
