<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

$titulo = 'PetCare - Sobre';
require_once __DIR__ . '/../app/views/components/header.php';
?>

<section class="page py-16">
    <div class="container max-w-4xl">
        <h1 class="text-4xl font-bold text-center mb-12 text-blue-900">Sobre a PetCare</h1>

        <div class="bg-white rounded-lg shadow-xl p-8 space-y-6">
            <p class="text-lg text-blue-900">
                A PetCare nasceu para oferecer carinho, saúde e qualidade de vida para pets e seus tutores. Trabalhamos com atenção individual, profissionais dedicados e uma experiência acolhedora em cada etapa do cuidado.
            </p>
            <p class="text-lg text-blue-900">
                Nosso objetivo é unir tecnologia, atendimento humano e serviços veterinários e de bem-estar para que cada animal receba o cuidado que merece.
            </p>
            <div class="grid md:grid-cols-3 gap-6 mt-10">
                <div class="bg-blue-50 p-6 rounded-lg text-center">
                    <div class="text-3xl text-yellow-500 mb-3"><i class="fa-solid fa-heart"></i></div>
                    <h3 class="font-bold text-blue-900">Carinho</h3>
                </div>
                <div class="bg-blue-50 p-6 rounded-lg text-center">
                    <div class="text-3xl text-yellow-500 mb-3"><i class="fa-solid fa-shield-heart"></i></div>
                    <h3 class="font-bold text-blue-900">Segurança</h3>
                </div>
                <div class="bg-blue-50 p-6 rounded-lg text-center">
                    <div class="text-3xl text-yellow-500 mb-3"><i class="fa-solid fa-user-doctor"></i></div>
                    <h3 class="font-bold text-blue-900">Expertise</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../app/views/components/footer.php'; ?>
