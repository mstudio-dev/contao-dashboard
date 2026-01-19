<?php

declare(strict_types=1);

namespace Mstudio\ContaoDashboard\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BackendMenuListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 20],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if (!$event->isMainRequest()) {
            return;
        }

        // Redirect /contao to /contao?do=dashboard
        if ($request->getPathInfo() === '/contao' && !$request->query->has('do')) {
            $event->setResponse(new RedirectResponse('/contao?do=dashboard'));
        }
    }
}
