<?php

declare(strict_types=1);

namespace Mstudio\ContaoDashboard\Controller;

use Contao\BackendModule;
use Contao\BackendUser;
use Contao\Database;
use Contao\System;

class DashboardController extends BackendModule
{
    protected $strTemplate = 'be_mstudio_dashboard';

    protected function compile(): void
    {
        $tiles = [];
        
        // Get current backend user
        $user = BackendUser::getInstance();
        
        if ($user && $user->id) {
            // Load favorites from tl_favorites table (only items with URL, no folders)
            $db = Database::getInstance();
            $favorites = $db->prepare("SELECT * FROM tl_favorites WHERE user=? AND url != '' ORDER BY sorting")
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
        
        // Load standard Contao backend welcome screen
        $this->Template->welcomeScreen = $this->getWelcomeScreen();
    }
    
    private function getWelcomeScreen(): string
    {
        // Get the backend module class for the welcome screen
        $className = 'Contao\BackendIndex';
        
        if (!class_exists($className)) {
            return '';
        }
        
        try {
            // Create an instance of the BackendIndex module
            $module = System::importStatic($className);
            
            // Generate the welcome screen content
            if (method_exists($module, 'generate')) {
                return $module->generate();
            }
        } catch (\Exception $e) {
            // Silently fail if welcome screen cannot be loaded
        }
        
        return '';
    }
    
    private function getModuleIcon(string $module): string
    {
        // Extensive module-to-icon mapping
        $iconMap = [
            // Content modules
            'article' => 'home.svg',
            'page' => 'home.svg',
            'tpl_editor' => 'code.svg',
            
            // News & Events
            'news' => 'news.svg',
            'newsletter' => 'news.svg',
            'calendar' => 'calendar.svg',
            'faq' => 'news.svg',
            
            // Files & Media
            'files' => 'download.svg',
            'tl_files' => 'download.svg',
            'download' => 'download.svg',
            'downloads' => 'download.svg',
            
            // Forms & Communication
            'form' => 'form.svg',
            'comments' => 'mail.svg',
            
            // User management
            'user' => 'user.svg',
            'user_group' => 'user.svg',
            'member' => 'user.svg',
            'member_group' => 'user.svg',
            
            // Design & Layout
            'themes' => 'layout.svg',
            'page_layout' => 'layout.svg',
            'image_sizes' => 'image.svg',
            'style_sheets' => 'code.svg',
            
            // System & Settings
            'settings' => 'settings.svg',
            'maintenance' => 'settings.svg',
            'log' => 'settings.svg',
            'undo' => 'settings.svg',
            'login' => 'user.svg',
            'security' => 'user.svg',
            'opt_in' => 'mail.svg',
            'crawl' => 'settings.svg',
        ];
        
        // Direct mapping
        if (isset($iconMap[$module])) {
            return $iconMap[$module];
        }
        
        // Smart fallback based on module name patterns
        $moduleLower = strtolower($module);
        
        // Content-related
        if (preg_match('/(content|article|page|text|element)/', $moduleLower)) {
            return 'home.svg';
        }
        
        // News/Blog-related
        if (preg_match('/(news|blog|post|feed|rss)/', $moduleLower)) {
            return 'news.svg';
        }
        
        // Calendar/Event-related
        if (preg_match('/(calendar|event|appointment|booking)/', $moduleLower)) {
            return 'calendar.svg';
        }
        
        // File/Media-related
        if (preg_match('/(file|media|download|upload|document|asset)/', $moduleLower)) {
            return 'download.svg';
        }
        
        // Form-related
        if (preg_match('/(form|survey|poll|contact|submission)/', $moduleLower)) {
            return 'form.svg';
        }
        
        // User/Member-related
        if (preg_match('/(user|member|profile|account|group|role)/', $moduleLower)) {
            return 'user.svg';
        }
        
        // Mail/Communication-related
        if (preg_match('/(mail|email|message|newsletter|notification|comment)/', $moduleLower)) {
            return 'mail.svg';
        }
        
        // Design/Layout-related
        if (preg_match('/(theme|layout|template|design|style|css)/', $moduleLower)) {
            return 'layout.svg';
        }
        
        // Image-related
        if (preg_match('/(image|picture|photo|gallery|album)/', $moduleLower)) {
            return 'image.svg';
        }
        
        // Code/Development-related
        if (preg_match('/(code|script|module|extension|plugin|bundle)/', $moduleLower)) {
            return 'code.svg';
        }
        
        // Settings/Config-related
        if (preg_match('/(setting|config|system|maintenance|log|security|crawl)/', $moduleLower)) {
            return 'settings.svg';
        }
        
        // Default fallback
        return 'dashboard.svg';
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
