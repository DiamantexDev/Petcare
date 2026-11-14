<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

$titulo = 'PetCare - Cadastro';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = getPdo();
        AuthController::registerClient($pdo, $_POST);
        redirectWithMessage('/login.php', 'success', 'Cadastro realizado com sucesso. Faça login para continuar.');
    } catch (Throwable $exception) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => $exception->getMessage()];
    }
}

require_once __DIR__ . '/../app/views/components/header.php';
$flash = getFlashMessage();
?>

<section class="page py-16" aria-labelledby="register-heading">
    <div class="container max-w-2xl">
        <h1 id="register-heading" class="text-4xl font-bold text-center mb-12 text-blue-900">Cadastro de Cliente</h1>

        <?php if ($flash): ?>
            <div class="alert-info p-4 mb-6 <?= $flash['type'] === 'error' ? 'text-red-700 bg-red-100 border-red-300' : 'text-green-700 bg-green-100 border-green-300' ?>">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="bg-white p-8 rounded-lg shadow-xl">
            <form method="POST" action="/cadastro.php" class="space-y-6" aria-label="Formulário de Cadastro de Cliente">
                <fieldset>
                    <legend class="text-xl font-semibold mb-4 text-blue-800">Informações Pessoais</legend>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="nome" class="block text-sm font-medium mb-1">Nome Completo</label>
                            <input type="text" id="nome" name="nome" required class="form-input">
                        </div>
                        <div>
                            <label for="cpf" class="block text-sm font-medium mb-1">CPF</label>
                            <input type="text" id="cpf" name="cpf" required class="form-input" placeholder="000.000.000-00">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="email" class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" id="email" name="email" required class="form-input">
                        </div>
                        <div>
                            <label for="telefone" class="block text-sm font-medium mb-1">Telefone</label>
                            <input type="tel" id="telefone" name="telefone" required class="form-input" placeholder="(11) 99999-9999">
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend class="text-xl font-semibold mb-4 text-blue-800">Endereço</legend>
                    <div>
                        <label for="logradouro" class="block text-sm font-medium mb-1">Logradouro</label>
                        <input type="text" id="logradouro" name="logradouro" required class="form-input">
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="numero" class="block text-sm font-medium mb-1">Número</label>
                            <input type="text" id="numero" name="numero" required class="form-input">
                        </div>
                        <div>
                            <label for="bairro" class="block text-sm font-medium mb-1">Bairro</label>
                            <input type="text" id="bairro" name="bairro" required class="form-input">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="complemento" class="block text-sm font-medium mb-1">Complemento</label>
                        <input type="text" id="complemento" name="complemento" class="form-input" placeholder="Ex.: casa 2">
                    </div>

                    <div class="grid md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label for="cidade" class="block text-sm font-medium mb-1">Cidade</label>
                            <input type="text" id="cidade" name="cidade" required class="form-input">
                        </div>
                        <div>
                            <label for="estado" class="block text-sm font-medium mb-1">Estado</label>
                            <select id="estado" name="estado" required class="form-select">
                                <option value="">Selecione</option>
                                <option value="SP">São Paulo</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="RS">Rio Grande do Sul</option>
                            </select>
                        </div>
                        <div>
                            <label for="cep" class="block text-sm font-medium mb-1">CEP</label>
                            <input type="text" id="cep" name="cep" required class="form-input" placeholder="00000-000">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="senha" class="block text-sm font-medium mb-1">Senha</label>
                        <input type="password" id="senha" name="senha" required class="form-input">
                    </div>
                </fieldset>

                <button type="submit" class="btn-full mt-6">Cadastrar Cliente</button>
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../app/views/components/footer.php'; ?>
