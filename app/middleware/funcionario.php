<?php

declare(strict_types=1);

require_once __DIR__ . '/../helpers/auth.php';

function ensureFuncionarioAccess(): void
{
    if (!userIsFuncionario()) {
        redirect('/403.php');
    }
}
