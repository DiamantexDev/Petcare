<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/middleware/funcionario.php';

ensureFuncionarioAccess();

$pdo = getPdo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        ServicoController::store($pdo, $_POST);
        redirectWithMessage('/funcionario/servicos.php', 'success', 'Serviço cadastrado com sucesso.');
    } catch (Throwable $exception) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => $exception->getMessage()];
    }
}

$servicos = Servico::all($pdo);

$titulo = 'PetCare - Serviços';
require_once __DIR__ . '/../../app/views/components/header.php';
$flash = getFlashMessage();
?>

<section class="page py-16">
    <div class="container max-w-4xl">
        <h1 class="text-4xl font-bold text-blue-900 mb-8">Serviços</h1>

        <?php if ($flash): ?>
            <div class="alert-info p-4 mb-6 <?= $flash['type'] === 'error' ? 'text-red-700 bg-red-100 border-red-300' : 'text-green-700 bg-green-100 border-green-300' ?>">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="grid md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Cadastrar serviço</h2>
                <form method="POST" action="/funcionario/servicos.php" class="space-y-4">
                    <div>
                        <label for="nome" class="block text-sm font-medium mb-1">Nome</label>
                        <input type="text" id="nome" name="nome" required class="form-input">
                    </div>
                    <div>
                        <label for="descricao" class="block text-sm font-medium mb-1">Descrição</label>
                        <textarea id="descricao" name="descricao" required rows="4" class="form-textarea"></textarea>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="preco" class="block text-sm font-medium mb-1">Preço</label>
                            <input type="number" step="0.01" min="0" id="preco" name="preco" required class="form-input">
                        </div>
                        <div>
                            <label for="duracao_minutos" class="block text-sm font-medium mb-1">Duração (min)</label>
                            <input type="number" min="15" id="duracao_minutos" name="duracao_minutos" value="60" class="form-input">
                        </div>
                    </div>
                    <button type="submit" class="btn-full">Salvar serviço</button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Serviços cadastrados</h2>
                <?php foreach ($servicos as $servico): ?>
                    <div class="border-b border-blue-100 py-3">
                        <p><strong><?= e($servico['nome']) ?></strong></p>
                        <p><?= e($servico['descricao']) ?></p>
                        <p>Preço: R$ <?= e((string) $servico['preco']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
