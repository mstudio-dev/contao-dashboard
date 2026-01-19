<?php

declare(strict_types=1);

namespace Mstudio\ContaoDashboard;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MstudioContaoDashboardBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}

