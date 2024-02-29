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
     * @param array<string, array{
     *     bezelColor: string,
     *     sidebarColor: string,
     *     signet: array{url: string, size: string, position: string},
     *     tabBarIcon: array{url: string, size: string|null, position: string|null},
     * }> $config
     */
    public function __construct(
        private readonly string $env,
        private readonly array $config,
    ) {
    }

    public function __invoke(): Response
    {
        $config = $this->config[$this->env] ?? [];
        $css = [];

        if ($bezelColor = $config['bezelColor'] ?? null) {
            $css[] = <<<CSS
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
                #pimcore_loading.loaded {
                    background-color: {$bezelColor};
                }
                .x-body .sf-minitoolbar {
                    background-color: {$bezelColor};
                }
                CSS;
        }

        if ($sidebarColor = $config['sidebarColor'] ?? null) {
            $css[] = <<<CSS
                #pimcore_sidebar {
                    background-color: {$sidebarColor};
                }
                #pimcore_loading.loaded {
                    background-color: {$sidebarColor};
                }
                .x-body .sf-minitoolbar {
                    background-color: {$sidebarColor};
                }
                CSS;
        }

        if ($signet = $config['signet'] ?? null) {
            $css[] = <<<CSS
                #pimcore_signet {
                    background-image: url({$signet['url']});
                    background-size: {$signet['size']};
                    background-position: {$signet['position']};
                }
                CSS;
        }

        if ($tabBarIcon = $config['tabBarIcon'] ?? null) {
            $css[] = '#pimcore_panel_tabs > .x-panel-bodyWrap > .x-tab-bar {';
            $css[] = "    background-image: url({$tabBarIcon['url']});";
            if ($tabBarIcon['size']) {
                $css[] = "    background-size: {$tabBarIcon['size']};";
            }
            if ($tabBarIcon['position']) {
                $css[] = "    background-position: {$tabBarIcon['position']};";
            }
            $css[] = '}';
        }

        return new Response(implode("\n", $css), Response::HTTP_OK, ['Content-type' => 'text/css']);
    }
}
