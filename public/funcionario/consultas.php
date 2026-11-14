<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/middleware/funcionario.php';

ensureFuncionarioAccess();

$pdo = getPdo();
$pets = Pet::all($pdo);
$funcionarios = Funcionario::all($pdo);
$servicos = Servico::all($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        ConsultaController::store($pdo, $_POST);
        redirectWithMessage('/funcionario/consultas.php', 'success', 'Consulta registrada com sucesso.');
    } catch (Throwable $exception) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => $exception->getMessage()];
    }
}

$consultas = Consulta::all($pdo);

$titulo = 'PetCare - Consultas';
require_once __DIR__ . '/../../app/views/components/header.php';
$flash = getFlashMessage();
?>

<section class="page py-16">
    <div class="container max-w-5xl">
        <h1 class="text-4xl font-bold text-blue-900 mb-8">Consultas</h1>

        <?php if ($flash): ?>
            <div class="alert-info p-4 mb-6 <?= $flash['type'] === 'error' ? 'text-red-700 bg-red-100 border-red-300' : 'text-green-700 bg-green-100 border-green-300' ?>">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="grid md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Nova consulta</h2>
                <form method="POST" action="/funcionario/consultas.php" class="space-y-4">
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
                        <label for="funcionario_id" class="block text-sm font-medium mb-1">Veterinário</label>
                        <select id="funcionario_id" name="funcionario_id" class="form-select">
                            <option value="">Selecione</option>
                            <?php foreach ($funcionarios as $funcionario): ?>
                                <option value="<?= e((string) $funcionario['id']) ?>"><?= e($funcionario['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="servico_id" class="block text-sm font-medium mb-1">Serviço</label>
                        <select id="servico_id" name="servico_id" class="form-select">
                            <option value="">Selecione</option>
                            <?php foreach ($servicos as $servico): ?>
                                <option value="<?= e((string) $servico['id']) ?>"><?= e($servico['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="data_hora" class="block text-sm font-medium mb-1">Data e hora</label>
                        <input type="datetime-local" id="data_hora" name="data_hora" required class="form-input">
                    </div>
                    <div>
                        <label for="diagnostico" class="block text-sm font-medium mb-1">Diagnóstico</label>
                        <textarea id="diagnostico" name="diagnostico" rows="3" class="form-textarea"></textarea>
                    </div>
                    <div>
                        <label for="observacoes" class="block text-sm font-medium mb-1">Observações</label>
                        <textarea id="observacoes" name="observacoes" rows="3" class="form-textarea"></textarea>
                    </div>
                    <button type="submit" class="btn-full">Registrar consulta</button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Histórico</h2>
                <?php foreach ($consultas as $consulta): ?>
                    <div class="border-b border-blue-100 py-3">
                        <p><strong>Pet:</strong> <?= e($consulta['pet_nome'] ?? '-') ?></p>
                        <p><strong>Funcionario:</strong> <?= e($consulta['funcionario_nome'] ?? '-') ?></p>
                        <p><strong>Data:</strong> <?= e(date('d/m/Y H:i', strtotime($consulta['data_hora']))) ?></p>
                        <p><strong>Status:</strong> <?= e($consulta['status']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
