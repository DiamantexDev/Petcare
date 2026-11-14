<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/middleware/funcionario.php';

ensureFuncionarioAccess();

$pdo = getPdo();
$pets = Pet::all($pdo);

$titulo = 'PetCare - Pets';
require_once __DIR__ . '/../../app/views/components/header.php';
?>

<section class="page py-16">
    <div class="container">
        <h1 class="text-4xl font-bold text-blue-900 mb-8">Pets</h1>

        <div class="grid md:grid-cols-2 gap-6">
            <?php foreach ($pets as $pet): ?>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold text-blue-900 mb-2"><?= e($pet['nome']) ?></h2>
                    <p><strong>Tipo:</strong> <?= e($pet['tipo']) ?></p>
                    <p><strong>Raça:</strong> <?= e($pet['raca'] ?? 'Não informado') ?></p>
                    <p><strong>Dono:</strong> <?= e($pet['dono'] ?? 'Não informado') ?></p>
                    <p><strong>Peso:</strong> <?= e($pet['peso'] ?? 'Não informado') ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
