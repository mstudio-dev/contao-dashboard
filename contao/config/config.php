<?php

declare(strict_types=1);

use Mstudio\ContaoDashboard\Controller\DashboardController;

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['system']['dashboard'] = [
    'callback' => DashboardController::class,
];
