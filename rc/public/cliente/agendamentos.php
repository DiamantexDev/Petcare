<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/middleware/cliente.php';

ensureClientAccess();

$pdo = getPdo();
$usuario = userSession();
$cliente = Cliente::findByUsuarioId($pdo, (int) $usuario['id']);
$pets = $cliente ? Pet::forClient($pdo, (int) $cliente['id']) : [];
$servicos = Servico::all($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        AgendamentoController::store($pdo, [
            'cliente_id' => (int) $cliente['id'],
            'pet_id' => $_POST['pet_id'],
            'servico_id' => $_POST['servico_id'],
            'data_hora' => $_POST['data_hora'],
            'observacoes' => $_POST['observacoes'] ?? '',
            'status' => 'pendente',
        ]);
        redirectWithMessage('/cliente/agendamentos.php', 'success', 'Agendamento realizado com sucesso.');
    } catch (Throwable $exception) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => $exception->getMessage()];
    }
}

$agendamentos = $cliente ? Agendamento::forCliente($pdo, (int) $cliente['id']) : [];

$titulo = 'PetCare - Agendamentos';
require_once __DIR__ . '/../../app/views/components/header.php';
$flash = getFlashMessage();
?>

<section class="page py-16">
    <div class="container">
        <h1 class="text-4xl font-bold mb-8 text-blue-900">Agendamentos</h1>

        <?php if ($flash): ?>
            <div class="alert-info p-4 mb-6 <?= $flash['type'] === 'error' ? 'text-red-700 bg-red-100 border-red-300' : 'text-green-700 bg-green-100 border-green-300' ?>">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="grid md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Novo agendamento</h2>
                <form method="POST" action="/cliente/agendamentos.php" class="space-y-4">
                    <div>
                        <label for="pet_id" class="block text-sm font-medium mb-1">Pet</label>
                        <select id="pet_id" name="pet_id" required class="form-select">
                            <option value="">Selecione</option>
                            <?php foreach ($pets as $pet): ?>
                                <option value="<?= e((string) $pet['id']) ?>"><?= e($pet['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="servico_id" class="block text-sm font-medium mb-1">Serviço</label>
                        <select id="servico_id" name="servico_id" required class="form-select">
                            <option value="">Selecione</option>
                            <?php foreach ($servicos as $servico): ?>
                                <option value="<?= e((string) $servico['id']) ?>"><?= e($servico['nome']) ?> - R$ <?= e((string) $servico['preco']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="data_hora" class="block text-sm font-medium mb-1">Data e hora</label>
                        <input type="datetime-local" id="data_hora" name="data_hora" required class="form-input">
                    </div>
                    <div>
                        <label for="observacoes" class="block text-sm font-medium mb-1">Observações</label>
                        <textarea id="observacoes" name="observacoes" rows="4" class="form-textarea"></textarea>
                    </div>
                    <button type="submit" class="btn-full">Agendar</button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Histórico</h2>
                <?php if (empty($agendamentos)): ?>
                    <p>Nenhum agendamento encontrado.</p>
                <?php else: ?>
                    <?php foreach ($agendamentos as $agendamento): ?>
                        <div class="border-b border-blue-100 py-3">
                            <p><strong>Pet:</strong> <?= e($agendamento['pet_nome']) ?></p>
                            <p><strong>Serviço:</strong> <?= e($agendamento['servico_nome']) ?></p>
                            <p><strong>Data:</strong> <?= e(date('d/m/Y H:i', strtotime($agendamento['data_hora']))) ?></p>
                            <p><strong>Status:</strong> <?= e($agendamento['status']) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
