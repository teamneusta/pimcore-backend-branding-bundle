<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\CssProvider;

use Neusta\Pimcore\BackendBrandingBundle\Attributes\AsCssProvider;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssProperty;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;
use Neusta\Pimcore\BackendBrandingBundle\Settings;

#[AsCssProvider]
final class TabBarIcon
{
    public function __construct(
        private readonly Settings $settings,
    ) {
    }

    /**
     * @return iterable<CssRule>
     */
    public function __invoke(): iterable
    {
        if (!isset($this->settings->tabBarIcon)) {
            return;
        }

        $tabBarIconRule = new CssRule('#pimcore_panel_tabs > .x-panel-bodyWrap > .x-tab-bar',
            new CssProperty('background-image', $this->settings->tabBarIcon->url, isUrl: true),
        );

        if (isset($this->settings->tabBarIcon->size)) {
            $tabBarIconRule->setProperty(new CssProperty('background-size', $this->settings->tabBarIcon->size));
        }

        if (isset($this->settings->tabBarIcon->position)) {
            $tabBarIconRule->setProperty(new CssProperty('background-position', $this->settings->tabBarIcon->position));
        }

        yield $tabBarIconRule;
    }
}
