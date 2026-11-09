<?php

declare(strict_types=1);

require_once __DIR__ . '/../helpers/auth.php';

function ensureClientAccess(): void
{
    if (!userIsClient()) {
        redirect('/403.php');
    }
}
