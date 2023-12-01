<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\EventListener;

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

    /**
     * @param array<string, array{
     *     favIcon?: string,
     *     title?: array{login: string|null, backend: string|null},
     * }> $config
     */
    public function __construct(
        private readonly string $env,
        private readonly array $config,
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
        $config = $this->config[$this->env] ?? null;

        if (!$content || !$config) {
            return;
        }

        if ($titleConfig = $config['title'] ?? null) {
            $loggedIn = null !== Session::getSessionBag($request->getSession(), 'pimcore_admin')?->get('user');
            $title = $loggedIn ? $titleConfig['backend'] : $titleConfig['login'];

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

        if ($favIcon = $config['favIcon'] ?? null) {
            $replaced = preg_replace(
                '#<link rel="icon"[^>]+>#',
                sprintf('<link rel="shortcut icon" href="%s">', $favIcon),
                $content,
            );

            if (null !== $replaced) {
                $content = $replaced;
            }
        }

        $response->setContent($content);
    }
}
