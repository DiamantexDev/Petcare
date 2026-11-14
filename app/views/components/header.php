<?php

declare(strict_types=1);

$usuario = userSession();
$paginaAtual = $_SERVER['PHP_SELF'] ?? '/index.php';
function menuAtivo(string $paginaAtual, string $rota): bool
{
    return $paginaAtual === $rota;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titulo) ? e($titulo) : 'PetCare' ?></title>
    <link rel="icon" href="<?= e(petcareAssetUrl('assets/img/favicon.ico')) ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= e(petcareAssetUrl('css/style.css')) ?>">
</head>
<body>
    <header class="main-header">
        <nav class="container nav-content" aria-label="Navegação Principal">
            <div class="logo-container">
                <a href="<?= e(petcarePageUrl('index.php')) ?>" class="flex items-center space-x-2">
                    <img src="<?= e(petcareAssetUrl('assets/img/logo-petcare.png')) ?>" alt="Logo PetCare" class="h-16 w-16">
                    <h1>PetCare</h1>
                </a>
            </div>

            <ul class="nav-links" role="menubar">
                <li><a href="<?= e(petcarePageUrl('index.php')) ?>" class="nav-btn" role="menuitem">Início</a></li>

                <?php if (!$usuario): ?>
                    <li><a href="<?= e(petcarePageUrl('cadastro.php')) ?>" class="nav-btn">Cadastro</a></li>
                    <li><a href="<?= e(petcarePageUrl('contato.php')) ?>" class="nav-btn">Contato</a></li>
                    <li><a href="<?= e(petcarePageUrl('sobre.php')) ?>" class="nav-btn">Sobre</a></li>
                    <li><a href="<?= e(petcarePageUrl('login.php')) ?>" class="nav-btn">Login</a></li>
                <?php else: ?>
                    <?php if ($usuario['tipo'] === 'cliente'): ?>
                        <li><a href="<?= e(petcarePageUrl('cliente/dashboard.php')) ?>" class="nav-btn">Minha conta</a></li>
                        <li><a href="<?= e(petcarePageUrl('cliente/pets.php')) ?>" class="nav-btn">Meus pets</a></li>
                        <li><a href="<?= e(petcarePageUrl('cliente/agendamentos.php')) ?>" class="nav-btn">Agendamentos</a></li>
                        <li><a href="<?= e(petcarePageUrl('logout.php')) ?>" class="nav-btn">Sair</a></li>
                    <?php else: ?>
                        <li><a href="<?= e(petcarePageUrl('funcionario/dashboard.php')) ?>" class="nav-btn">Dashboard</a></li>
                        <li><a href="<?= e(petcarePageUrl('funcionario/clientes.php')) ?>" class="nav-btn">Clientes</a></li>
                        <li><a href="<?= e(petcarePageUrl('funcionario/funcionarios.php')) ?>" class="nav-btn">Funcionários</a></li>
                        <li><a href="<?= e(petcarePageUrl('funcionario/pets.php')) ?>" class="nav-btn">Pets</a></li>
                        <li><a href="<?= e(petcarePageUrl('funcionario/servicos.php')) ?>" class="nav-btn">Serviços</a></li>
                        <li><a href="<?= e(petcarePageUrl('funcionario/consultas.php')) ?>" class="nav-btn">Consultas</a></li>
                        <li><a href="<?= e(petcarePageUrl('funcionario/agendamentos.php')) ?>" class="nav-btn">Agendamentos</a></li>
                        <li><a href="<?= e(petcarePageUrl('logout.php')) ?>" class="nav-btn">Sair</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <button aria-label="Abrir menu mobile" class="menu-toggle" type="button" onclick="document.getElementById('mobileMenu').classList.toggle('active')">
                <i class="fa-solid fa-bars w-6 h-6"></i>
            </button>
        </nav>

        <div id="mobileMenu" class="mobile-menu">
            <a href="<?= e(petcarePageUrl('index.php')) ?>">Início</a>
            <?php if (!$usuario): ?>
                <a href="<?= e(petcarePageUrl('cadastro.php')) ?>">Cadastro</a>
                <a href="<?= e(petcarePageUrl('contato.php')) ?>">Contato</a>
                <a href="<?= e(petcarePageUrl('sobre.php')) ?>">Sobre</a>
                <a href="<?= e(petcarePageUrl('login.php')) ?>">Login</a>
            <?php else: ?>
                <?php if ($usuario['tipo'] === 'cliente'): ?>
                    <a href="<?= e(petcarePageUrl('cliente/dashboard.php')) ?>">Minha conta</a>
                    <a href="<?= e(petcarePageUrl('cliente/pets.php')) ?>">Meus pets</a>
                    <a href="<?= e(petcarePageUrl('cliente/agendamentos.php')) ?>">Agendamentos</a>
                    <a href="<?= e(petcarePageUrl('logout.php')) ?>">Sair</a>
                <?php else: ?>
                    <a href="<?= e(petcarePageUrl('funcionario/dashboard.php')) ?>">Dashboard</a>
                    <a href="<?= e(petcarePageUrl('funcionario/clientes.php')) ?>">Clientes</a>
                    <a href="<?= e(petcarePageUrl('funcionario/funcionarios.php')) ?>">Funcionários</a>
                    <a href="<?= e(petcarePageUrl('funcionario/pets.php')) ?>">Pets</a>
                    <a href="<?= e(petcarePageUrl('funcionario/servicos.php')) ?>">Serviços</a>
                    <a href="<?= e(petcarePageUrl('funcionario/consultas.php')) ?>">Consultas</a>
                    <a href="<?= e(petcarePageUrl('funcionario/agendamentos.php')) ?>">Agendamentos</a>
                    <a href="<?= e(petcarePageUrl('logout.php')) ?>">Sair</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </header>

    <main>
