<?php

declare(strict_types=1);

namespace Mstudio\ContaoDashboard\Controller;

use Contao\BackendModule;
use Contao\BackendUser;
use Contao\Database;

class DashboardController extends BackendModule
{
    protected $strTemplate = 'be_mstudio_dashboard';

    protected function compile(): void
    {
        $tiles = [];
        
        // Get current backend user
        $user = BackendUser::getInstance();
        
        if ($user && $user->id) {
            // Load favorites from tl_favorites table
            $db = Database::getInstance();
            $favorites = $db->prepare("SELECT * FROM tl_favorites WHERE user=? ORDER BY sorting")
                            ->execute($user->id);
            
            while ($favorites->next()) {
                $url = $favorites->url;
                
                // Extract module name from URL
                if (preg_match('/do=([a-zA-Z0-9_]+)/', $url, $matches)) {
                    $module = $matches[1];
                    
                    $tiles[] = [
                        'label' => $favorites->title ?: $module,
                        'icon'  => $this->getModuleIcon($module),
                        'href'  => ltrim($url, '/'),
                    ];
                }
            }
        }
        
        // Fallback to default tiles if no favorites
        if (empty($tiles)) {
            $tiles = $GLOBALS['DASHBOARD_TILES'] ?? $this->getDefaultTiles();
        }
        
        $this->Template->tiles = $tiles;
    }
    
    private function getModuleIcon(string $module): string
    {
        // Map common modules to icons
        $iconMap = [
            'article' => 'home.svg',
            'page' => 'home.svg',
            'news' => 'news.svg',
            'calendar' => 'calendar.svg',
            'newsletter' => 'news.svg',
            'files' => 'download.svg',
            'form' => 'download.svg',
            'user' => 'home.svg',
        ];
        
        return $iconMap[$module] ?? 'dashboard.svg';
    }
    
    private function getDefaultTiles(): array
    {
        return [
            [
                'label' => 'Seitenstruktur',
                'icon'  => 'home.svg',
                'href'  => 'contao?do=page',
            ],
            [
                'label' => 'Artikel',
                'icon'  => 'home.svg',
                'href'  => 'contao?do=article',
            ],
            [
                'label' => 'Dateien',
                'icon'  => 'download.svg',
                'href'  => 'contao?do=files',
            ],
        ];
    }
}
