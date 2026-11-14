<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

$titulo = 'PetCare - Início';
require_once __DIR__ . '/../app/views/components/header.php';
?>

<section class="page" aria-labelledby="home-heading">
    <div class="hero-section">
        <div class="container">
            <h1 id="home-heading">Bem-vindo ao PetCare</h1>
            <p class="text-xl">O melhor cuidado para seu melhor amigo</p>
            <div class="flex justify-center space-x-4 mt-8">
                <a href="/cadastro.php" class="btn btn-primary">Cadastre-se</a>
                <a href="/login.php" class="btn btn-secondary">Faça login</a>
            </div>
        </div>
    </div>

    <section class="services-preview py-16">
        <div class="container">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-900">Nossos Serviços</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <article class="service-card" aria-label="Serviço de Banho e Tosa">
                    <div class="text-4xl mb-4 text-yellow-500"><i class="fa-solid fa-bath"></i></div>
                    <h3 class="text-lg">Banho & Tosa</h3>
                    <p>Serviços profissionais de higiene e estética para manter seu pet lindo e saudável.</p>
                </article>
                <article class="service-card" aria-label="Serviço de Cuidado Especial">
                    <div class="text-4xl mb-4 text-yellow-500"><i class="fa-solid fa-heart-pulse"></i></div>
                    <h3 class="text-lg">Cuidado Especial</h3>
                    <p>Atendimento personalizado com foco em bem-estar, conforto e atenção individual.</p>
                </article>
                <article class="service-card" aria-label="Consulta Veterinária">
                    <div class="text-4xl mb-4 text-yellow-500"><i class="fa-solid fa-stethoscope"></i></div>
                    <h3 class="text-lg">Consulta Veterinária</h3>
                    <p>Consultas para cuidar da saúde do seu pet com diagnóstico e orientação profissional.</p>
                </article>
                <article class="service-card" aria-label="Vacinas">
                    <div class="text-4xl mb-4 text-yellow-500"><i class="fa-solid fa-syringe"></i></div>
                    <h3 class="text-lg">Vacinas</h3>
                    <p>Vacinação e acompanhamento para manter a proteção adequada em todas as fases da vida.</p>
                </article>
            </div>
        </div>
    </section>
</section>

<?php require_once __DIR__ . '/../app/views/components/footer.php'; ?>
