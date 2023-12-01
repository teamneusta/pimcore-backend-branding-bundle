<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController, Route('/neusta/backend-branding/css', name: 'neusta_pimcore_backend_branding_css')]
final class CssController
{
    /**
     * @param array<string, array{bezelColor: string}> $config
     */
    public function __construct(
        private readonly string $env,
        private readonly array $config,
    ) {
    }

    public function __invoke(): Response
    {
        $bezelColor = $this->config[$this->env]['bezelColor'] ?? null;

        return new Response($bezelColor ? <<<CSS
            body.x-body #pimcore_body {
                background-color: {$bezelColor};
            }
            body.x-body #pimcore_loading.loaded {
                background-color: {$bezelColor};
            }
            body.x-body .sf-minitoolbar {
                background-color: {$bezelColor};
            }
            body.x-body #pimcore_panel_tabs > .x-panel-bodyWrap > .x-tab-bar {
                background-color: {$bezelColor};
            }
            CSS : '',
            Response::HTTP_OK,
            ['Content-type' => 'text/css'],
        );
    }
}
