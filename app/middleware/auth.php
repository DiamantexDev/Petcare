<?php

declare(strict_types=1);

function ensureAuthenticated(): void
{
    if (!isAuthenticated()) {
        redirect('/login.php');
    }
}
