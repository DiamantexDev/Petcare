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
    <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJd/rB0Jc65G6tM0fF5dO8C8r8J3x8f8E8qI8F5aL4P5aL4I4z9E9t5p9p9p9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header class="main-header">
        <nav class="container nav-content" aria-label="Navegação Principal">
            <div class="logo-container">
                <a href="/index.php" class="flex items-center space-x-2">
                    <img src="/assets/img/logo-petcare.png" alt="Logo PetCare" class="h-16 w-16">
                    <h1>PetCare</h1>
                </a>
            </div>

            <ul class="nav-links" role="menubar">
                <li><a href="/index.php" class="nav-btn" role="menuitem">Início</a></li>

                <?php if (!$usuario): ?>
                    <li><a href="/cadastro.php" class="nav-btn">Cadastro</a></li>
                    <li><a href="/contato.php" class="nav-btn">Contato</a></li>
                    <li><a href="/sobre.php" class="nav-btn">Sobre</a></li>
                    <li><a href="/login.php" class="nav-btn">Login</a></li>
                <?php else: ?>
                    <?php if ($usuario['tipo'] === 'cliente'): ?>
                        <li><a href="/cliente/dashboard.php" class="nav-btn">Minha conta</a></li>
                        <li><a href="/cliente/pets.php" class="nav-btn">Meus pets</a></li>
                        <li><a href="/cliente/agendamentos.php" class="nav-btn">Agendamentos</a></li>
                        <li><a href="/logout.php" class="nav-btn">Sair</a></li>
                    <?php else: ?>
                        <li><a href="/funcionario/dashboard.php" class="nav-btn">Dashboard</a></li>
                        <li><a href="/funcionario/clientes.php" class="nav-btn">Clientes</a></li>
                        <li><a href="/funcionario/funcionarios.php" class="nav-btn">Funcionários</a></li>
                        <li><a href="/funcionario/pets.php" class="nav-btn">Pets</a></li>
                        <li><a href="/funcionario/servicos.php" class="nav-btn">Serviços</a></li>
                        <li><a href="/funcionario/consultas.php" class="nav-btn">Consultas</a></li>
                        <li><a href="/funcionario/agendamentos.php" class="nav-btn">Agendamentos</a></li>
                        <li><a href="/logout.php" class="nav-btn">Sair</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <button aria-label="Abrir menu mobile" class="menu-toggle" type="button" onclick="document.getElementById('mobileMenu').classList.toggle('active')">
                <i class="fa-solid fa-bars w-6 h-6"></i>
            </button>
        </nav>

        <div id="mobileMenu" class="mobile-menu">
            <a href="/index.php">Início</a>
            <?php if (!$usuario): ?>
                <a href="/cadastro.php">Cadastro</a>
                <a href="/contato.php">Contato</a>
                <a href="/sobre.php">Sobre</a>
                <a href="/login.php">Login</a>
            <?php else: ?>
                <?php if ($usuario['tipo'] === 'cliente'): ?>
                    <a href="/cliente/dashboard.php">Minha conta</a>
                    <a href="/cliente/pets.php">Meus pets</a>
                    <a href="/cliente/agendamentos.php">Agendamentos</a>
                    <a href="/logout.php">Sair</a>
                <?php else: ?>
                    <a href="/funcionario/dashboard.php">Dashboard</a>
                    <a href="/funcionario/clientes.php">Clientes</a>
                    <a href="/funcionario/funcionarios.php">Funcionários</a>
                    <a href="/funcionario/pets.php">Pets</a>
                    <a href="/funcionario/servicos.php">Serviços</a>
                    <a href="/funcionario/consultas.php">Consultas</a>
                    <a href="/funcionario/agendamentos.php">Agendamentos</a>
                    <a href="/logout.php">Sair</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </header>

    <main>
