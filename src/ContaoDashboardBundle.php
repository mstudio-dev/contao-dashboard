<?php

declare(strict_types=1);

namespace Mstudio\ContaoDashboard;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoDashboardBundle extends Bundle implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(self::class)
                ->setLoadAfter(['ContaoCoreBundle']),
        ];
    }
}
