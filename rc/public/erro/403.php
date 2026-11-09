<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';

$titulo = 'PetCare - Acesso não autorizado';
require_once __DIR__ . '/../../app/views/components/header.php';
?>

<section class="page py-16">
    <div class="container max-w-xl text-center">
        <div class="bg-white p-12 rounded-lg shadow-xl">
            <div class="text-6xl text-red-500 mb-6"><i class="fa-solid fa-ban"></i></div>
            <h1 class="text-4xl font-bold text-blue-900 mb-4">403</h1>
            <h2 class="text-2xl font-semibold text-blue-800 mb-4">Acesso não autorizado</h2>
            <p class="text-lg text-blue-700 mb-8">Você não possui permissão para acessar esta área do sistema.</p>
            <a href="/index.php" class="btn btn-primary">Voltar para o início</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
