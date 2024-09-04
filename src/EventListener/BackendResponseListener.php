<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\EventListener;

use Neusta\Pimcore\BackendBrandingBundle\Settings;
use Pimcore\Tool;
use Pimcore\Tool\Session;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

#[AsEventListener]
final class BackendResponseListener
{
    private const INTERCEPTED_ROUTES = [
        'pimcore_admin_login',
        'pimcore_admin_login_fallback',
        'pimcore_admin_index',
    ];

    public function __construct(
        private readonly Settings $settings,
    ) {
    }

    public function __invoke(ResponseEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();

        if (!\in_array($request->attributes->get('_route'), self::INTERCEPTED_ROUTES, true)) {
            return;
        }

        $response = $event->getResponse();
        $content = $response->getContent();

        if (!$content) {
            return;
        }

        if (isset($this->settings->title)) {
            $loggedIn = null !== Session::getSessionBag($request->getSession(), 'pimcore_admin')?->get('user');
            $title = $loggedIn ? $this->settings->title->backend : $this->settings->title->login;

            if ($title) {
                $title = strtr($title, ['{hostname}' => htmlentities((string) Tool::getHostname(), \ENT_QUOTES, 'UTF-8')]);
                $replaced = preg_replace(
                    '#<title>(.+)</title>#',
                    "<title>{$title}</title>",
                    $content,
                );

                if (null !== $replaced) {
                    $content = $replaced;
                }
            }
        }

        if (isset($this->settings->favicon)) {
            $replaced = preg_replace(
                '#<link rel="icon"[^>]+>#',
                \sprintf('<link rel="shortcut icon" href="%s">', $this->settings->favicon),
                $content,
            );

            if (null !== $replaced) {
                $content = $replaced;
            }
        }

        $response->setContent($content);
    }
}
