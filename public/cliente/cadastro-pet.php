<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/middleware/cliente.php';

ensureClientAccess();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getPdo();
    try {
        PetController::store($pdo, userSession()['id'], $_POST);
        redirectWithMessage('/cliente/pets.php', 'success', 'Pet cadastrado com sucesso.');
    } catch (Throwable $exception) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => $exception->getMessage()];
    }
}

$titulo = 'PetCare - Cadastrar pet';
require_once __DIR__ . '/../../app/views/components/header.php';
$flash = getFlashMessage();
?>

<section class="page py-16">
    <div class="container max-w-2xl">
        <h1 class="text-4xl font-bold mb-8 text-blue-900">Cadastrar pet</h1>

        <?php if ($flash): ?>
            <div class="alert-info p-4 mb-6 <?= $flash['type'] === 'error' ? 'text-red-700 bg-red-100 border-red-300' : 'text-green-700 bg-green-100 border-green-300' ?>">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="bg-white p-8 rounded-lg shadow-xl">
            <form method="POST" action="/cliente/cadastro-pet.php" class="space-y-6">
                <div>
                    <label for="nome" class="block text-sm font-medium mb-1">Nome do pet</label>
                    <input type="text" id="nome" name="nome" required class="form-input">
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="tipo" class="block text-sm font-medium mb-1">Tipo</label>
                        <select id="tipo" name="tipo" required class="form-select">
                            <option value="">Selecione</option>
                            <option value="Cachorro">Cachorro</option>
                            <option value="Gato">Gato</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div>
                        <label for="raca" class="block text-sm font-medium mb-1">Raça</label>
                        <input type="text" id="raca" name="raca" class="form-input">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="idade" class="block text-sm font-medium mb-1">Idade</label>
                        <input type="text" id="idade" name="idade" class="form-input">
                    </div>
                    <div>
                        <label for="peso" class="block text-sm font-medium mb-1">Peso</label>
                        <input type="text" id="peso" name="peso" class="form-input">
                    </div>
                </div>
                <div>
                    <label for="observacoes" class="block text-sm font-medium mb-1">Observações</label>
                    <textarea id="observacoes" name="observacoes" rows="4" class="form-textarea"></textarea>
                </div>
                <button type="submit" class="btn-full">Salvar pet</button>
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../app/views/components/footer.php'; ?>
