<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

$titulo = 'PetCare - Login';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = getPdo();
        $dados = AuthController::login($pdo, $_POST);
        $redirect = $dados['tipo'] === 'cliente' ? '/cliente/dashboard.php' : '/funcionario/dashboard.php';
        redirectWithMessage($redirect, 'success', 'Login realizado com sucesso!');
    } catch (Throwable $exception) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => $exception->getMessage()];
    }
}

require_once __DIR__ . '/../app/views/components/header.php';
$flash = getFlashMessage();
?>

<section class="page py-16" aria-labelledby="login-heading">
    <div class="container max-w-sm">
        <h1 id="login-heading" class="text-4xl font-bold text-center mb-12 text-blue-900">Acesse sua conta</h1>

        <?php if ($flash): ?>
            <div class="alert-info p-4 mb-6 <?= $flash['type'] === 'error' ? 'text-red-700 bg-red-100 border-red-300' : 'text-green-700 bg-green-100 border-green-300' ?>">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="bg-white p-8 rounded-lg shadow-xl">
            <form method="POST" action="/login.php" class="space-y-6" aria-label="Formulário de Login">
                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email" required class="form-input" placeholder="seu.email@exemplo.com">
                </div>
                <div>
                    <label for="senha" class="block text-sm font-medium mb-1">Senha</label>
                    <input type="password" id="senha" name="senha" required class="form-input" placeholder="••••••••">
                </div>
                <button type="submit" class="btn-full">Entrar</button>
                <p class="text-center text-sm mt-4">
                    Novo por aqui? <a href="/cadastro.php" class="text-blue-600 hover:text-blue-800 font-medium">Cadastre-se</a>
                </p>
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../app/views/components/footer.php'; ?>
