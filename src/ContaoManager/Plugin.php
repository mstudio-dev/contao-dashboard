<?php

declare(strict_types=1);

namespace Mstudio\ContaoDashboard\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Mstudio\ContaoDashboard\MstudioContaoDashboardBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(MstudioContaoDashboardBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
