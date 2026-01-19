<?php

declare(strict_types=1);

namespace Mstudio\ContaoDashboard\Widget;

use Symfony\Contracts\Translation\TranslatorInterface;

class ImportantActionsWidget
{
    public function __construct(private readonly TranslatorInterface $translator)
    {
    }

    public function getType(): string
    {
        return 'important-actions';
    }

    public function getTitle(): string
    {
        return $this->translator->trans('Wichtige Aktionen', [], 'contao_default');
    }

    public function generate(): string
    {
        $actions = [
            [
                'label' => 'Seitenstruktur',
                'href' => 'contao?do=page',
                'icon' => 'page.svg',
            ],
            [
                'label' => 'Benutzerverwaltung',
                'href' => 'contao?do=user',
                'icon' => 'user.svg',
            ],
            [
                'label' => 'Dateiverwaltung',
                'href' => 'contao?do=files',
                'icon' => 'files.svg',
            ],
            [
                'label' => 'Einstellungen',
                'href' => 'contao?do=settings',
                'icon' => 'settings.svg',
            ],
        ];

        $html = '<div class="widget-content"><h2>'.$this->getTitle().'</h2>';
        $html .= '<ul class="widget-actions">';
        
        foreach ($actions as $action) {
            $html .= sprintf(
                '<li><a href="%s">%s</a></li>',
                $action['href'],
                $action['label']
            );
        }
        
        $html .= '</ul></div>';
        
        return $html;
    }
}
