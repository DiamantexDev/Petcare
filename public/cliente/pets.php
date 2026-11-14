<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/middleware/cliente.php';

ensureClientAccess();

$pdo = getPdo();
$usuario = userSession();
$cliente = Cliente::findByUsuarioId($pdo, (int) $usuario['id']);
$pets = $cliente ? Pet::forClient($pdo, (int) $cliente['id']) : [];

$titulo = 'PetCare - Meus pets';
require_once __DIR__ . '/../../app/views/components/header.php';
$flash = getFlashMessage();
?>

<section class="page py-16">
    <div class="container">
        <div class="flex justify-between items-center mb-8 gap-4">
            <h1 class="text-4xl font-bold text-blue-900">Meus pets</h1>
            <a href="/cliente/cadastro-pet.php" class="btn btn-primary">Cadastrar pet</a>
        </div>

        <?php if ($flash): ?>
            <div class="alert-info p-4 mb-6 <?= $flash['type'] === 'error' ? 'text-red-700 bg-red-100 border-red-300' : 'text-green-700 bg-green-100 border-green-300' ?>">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="grid md:grid-cols-2 gap-6">
            <?php foreach ($pets as $pet): ?>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold text-blue-900 mb-2"><?= e($pet['nome']) ?></h2>
                    <p><strong>Tipo:</strong> <?= e($pet['tipo']) ?></p>
                    <p><strong>Raça:</strong> <?= e($pet['raca'] ?? 'Não informado') ?></p>
                    <p><strong>Idade:</strong> <?= e($pet['idade'] ?? 'Não informado') ?></p>
                    <p><strong>Peso:</strong> <?= e($pet['peso'] ?? 'Não informado') ?></p>
                    <p><strong>Observações:</strong> <?= e($pet['observacoes'] ?? 'Sem observações') ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
