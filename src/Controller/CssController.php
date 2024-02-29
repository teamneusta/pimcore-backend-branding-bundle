<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Controller;

use Neusta\Pimcore\BackendBrandingBundle\Css\CssProperty;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRuleList;
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
     *     signet: array{url: string, size: string, position: string, color: string|null},
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
        $css = new CssRuleList();

        if (isset($config['bezelColor'])) {
            $bezelColor = new CssProperty('background-color', $config['bezelColor']);
            $css->addRule(new CssRule('body.x-body #pimcore_body', $bezelColor));
            $css->addRule(new CssRule('body.x-body #pimcore_loading.loaded', $bezelColor));
            $css->addRule(new CssRule('body.x-body .sf-minitoolbar', $bezelColor));
            $css->addRule(new CssRule('body.x-body #pimcore_panel_tabs > .x-panel-bodyWrap > .x-tab-bar', $bezelColor));
            $css->addRule(new CssRule('#pimcore_loading.loaded', $bezelColor));
            $css->addRule(new CssRule('.x-body .sf-minitoolbar', $bezelColor));
        }

        if (isset($config['sidebarColor'])) {
            $sidebarColor = new CssProperty('background-color', $config['sidebarColor']);
            $css->addRule(new CssRule('#pimcore_sidebar', $sidebarColor));
            $css->addRule(new CssRule('#pimcore_loading.loaded', $sidebarColor));
            $css->addRule(new CssRule('.x-body .sf-minitoolbar', $sidebarColor));
        }

        if (isset($config['signet'])) {
            $signet = new CssRule('#pimcore_signet',
                new CssProperty('background-image', $config['signet']['url'], isUrl: true),
                new CssProperty('background-size', $config['signet']['size']),
                new CssProperty('background-position', $config['signet']['position']),
            );

            if (isset($config['signet']['color'])) {
                $signet->setProperty(new CssProperty('background-color', $config['signet']['color'], isImportant: true));

                $css->addRule(new CssRule('#pimcore_avatar',
                    new CssProperty('background-color', $config['signet']['color'], isImportant: true),
                ));
            }

            $css->addRule($signet);
        }

        if (isset($config['tabBarIcon'])) {
            $tabBarIcon = new CssRule('#pimcore_panel_tabs > .x-panel-bodyWrap > .x-tab-bar',
                new CssProperty('background-image', $config['tabBarIcon']['url'], isUrl: true),
            );

            if (isset($config['tabBarIcon']['size'])) {
                $tabBarIcon->setProperty(new CssProperty('background-size', $config['tabBarIcon']['size']));
            }

            if (isset($config['tabBarIcon']['position'])) {
                $tabBarIcon->setProperty(new CssProperty('background-position', $config['tabBarIcon']['position']));
            }

            $css->addRule($tabBarIcon);
        }

        return new Response($css->toString(), Response::HTTP_OK, ['Content-type' => 'text/css']);
    }
}
