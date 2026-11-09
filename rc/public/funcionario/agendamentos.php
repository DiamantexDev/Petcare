<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/middleware/funcionario.php';

ensureFuncionarioAccess();

$pdo = getPdo();
$agendamentos = Agendamento::all($pdo);

$titulo = 'PetCare - Agendamentos';
require_once __DIR__ . '/../../app/views/components/header.php';
?>

<section class="page py-16">
    <div class="container">
        <h1 class="text-4xl font-bold text-blue-900 mb-8">Agendamentos</h1>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-blue-800 text-yellow-50">
                    <tr>
                        <th class="px-4 py-3 text-left">Cliente</th>
                        <th class="px-4 py-3 text-left">Pet</th>
                        <th class="px-4 py-3 text-left">Serviço</th>
                        <th class="px-4 py-3 text-left">Data</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agendamentos as $agendamento): ?>
                        <tr class="border-b border-blue-100">
                            <td class="px-4 py-3"><?= e($agendamento['cliente_nome']) ?></td>
                            <td class="px-4 py-3"><?= e($agendamento['pet_nome']) ?></td>
                            <td class="px-4 py-3"><?= e($agendamento['servico_nome']) ?></td>
                            <td class="px-4 py-3"><?= e(date('d/m/Y H:i', strtotime($agendamento['data_hora']))) ?></td>
                            <td class="px-4 py-3"><?= e($agendamento['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
