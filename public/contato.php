<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

$titulo = 'PetCare - Contato';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanitizeText($_POST['nome'] ?? '');
    $email = sanitizeEmail($_POST['email'] ?? '');
    $mensagem = sanitizeText($_POST['mensagem'] ?? '');

    if ($nome === '' || $email === '' || $mensagem === '') {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Preencha todos os campos do formulário de contato.'];
    } else {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Mensagem enviada com sucesso. Em breve entraremos em contato.'];
        redirect('/contato.php');
    }
}

require_once __DIR__ . '/../app/views/components/header.php';
$flash = getFlashMessage();
?>

<section class="page py-16">
    <div class="container max-w-3xl">
        <h1 class="text-4xl font-bold text-center mb-12 text-blue-900">Contato</h1>

        <?php if ($flash): ?>
            <div class="alert-info p-4 mb-6 <?= $flash['type'] === 'error' ? 'text-red-700 bg-red-100 border-red-300' : 'text-green-700 bg-green-100 border-green-300' ?>">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="bg-white p-8 rounded-lg shadow-xl">
            <form method="POST" action="/contato.php" class="space-y-6">
                <div>
                    <label for="nome" class="block text-sm font-medium mb-1">Nome</label>
                    <input type="text" id="nome" name="nome" required class="form-input">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium mb-1">E-mail</label>
                    <input type="email" id="email" name="email" required class="form-input">
                </div>
                <div>
                    <label for="mensagem" class="block text-sm font-medium mb-1">Mensagem</label>
                    <textarea id="mensagem" name="mensagem" rows="6" required class="form-textarea"></textarea>
                </div>
                <button type="submit" class="btn-full">Enviar mensagem</button>
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../app/views/components/footer.php'; ?>
