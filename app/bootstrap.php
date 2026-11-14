<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/helpers/auth.php';
require_once __DIR__ . '/helpers/redirect.php';
require_once __DIR__ . '/helpers/validation.php';

$models = [
    __DIR__ . '/models/Usuario.php',
    __DIR__ . '/models/Cliente.php',
    __DIR__ . '/models/Funcionario.php',
    __DIR__ . '/models/Pet.php',
    __DIR__ . '/models/Servico.php',
    __DIR__ . '/models/Consulta.php',
    __DIR__ . '/models/Agendamento.php',
];

foreach ($models as $modelFile) {
    require_once $modelFile;
}

$controllers = [
    __DIR__ . '/controllers/AuthController.php',
    __DIR__ . '/controllers/ClienteController.php',
    __DIR__ . '/controllers/FuncionarioController.php',
    __DIR__ . '/controllers/PetController.php',
    __DIR__ . '/controllers/ServicoController.php',
    __DIR__ . '/controllers/ConsultaController.php',
    __DIR__ . '/controllers/AgendamentoController.php',
];

foreach ($controllers as $controllerFile) {
    require_once $controllerFile;
}
