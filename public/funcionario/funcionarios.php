<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/middleware/funcionario.php';

ensureFuncionarioAccess();

$pdo = getPdo();
$funcionarios = Funcionario::all($pdo);

$titulo = 'PetCare - Funcionários';
require_once __DIR__ . '/../../app/views/components/header.php';
?>

<section class="page py-16">
    <div class="container">
        <h1 class="text-4xl font-bold text-blue-900 mb-8">Funcionários</h1>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-blue-800 text-yellow-50">
                    <tr>
                        <th class="px-4 py-3 text-left">Nome</th>
                        <th class="px-4 py-3 text-left">Cargo</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($funcionarios as $funcionario): ?>
                        <tr class="border-b border-blue-100">
                            <td class="px-4 py-3"><?= e($funcionario['nome']) ?></td>
                            <td class="px-4 py-3"><?= e($funcionario['cargo'] ?? 'Funcionário') ?></td>
                            <td class="px-4 py-3"><?= e($funcionario['email']) ?></td>
                            <td class="px-4 py-3"><?= e($funcionario['telefone']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
