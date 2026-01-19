<?php

declare(strict_types=1);

namespace Mstudio\ContaoDashboard\Controller;

use Contao\BackendModule;

class DashboardController extends BackendModule
{
    protected $strTemplate = 'be_mstudio_dashboard';

    protected function compile(): void
    {
        $this->Template->tiles = [
            [
                'label' => 'Startseite bearbeiten',
                'icon'  => 'home.svg',
                'href'  => 'contao?do=article&table=tl_content&id=2',
            ],
            [
                'label' => 'Aktuelles pflegen',
                'icon'  => 'news.svg',
                'href'  => 'contao?do=news',
            ],
            [
                'label' => 'Termine eintragen',
                'icon'  => 'calendar.svg',
                'href'  => 'contao?do=calendar',
            ],
            [
                'label' => 'Downloads verwalten',
                'icon'  => 'download.svg',
                'href'  => 'contao?do=files',
            ],
        ];
    }
}
