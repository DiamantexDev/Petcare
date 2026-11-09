<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/middleware/funcionario.php';

ensureFuncionarioAccess();

$pdo = getPdo();
$clientes = Cliente::all($pdo);

$titulo = 'PetCare - Clientes';
require_once __DIR__ . '/../../app/views/components/header.php';
?>

<section class="page py-16">
    <div class="container">
        <h1 class="text-4xl font-bold text-blue-900 mb-8">Clientes</h1>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-blue-800 text-yellow-50">
                    <tr>
                        <th class="px-4 py-3 text-left">Nome</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Telefone</th>
                        <th class="px-4 py-3 text-left">CPF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr class="border-b border-blue-100">
                            <td class="px-4 py-3"><?= e($cliente['nome']) ?></td>
                            <td class="px-4 py-3"><?= e($cliente['email']) ?></td>
                            <td class="px-4 py-3"><?= e($cliente['telefone']) ?></td>
                            <td class="px-4 py-3"><?= e($cliente['cpf']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
