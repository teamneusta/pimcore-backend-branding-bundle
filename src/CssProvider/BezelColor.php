<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\CssProvider;

use Neusta\Pimcore\BackendBrandingBundle\Attributes\AsCssProvider;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssProperty;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;
use Neusta\Pimcore\BackendBrandingBundle\Settings;

#[AsCssProvider]
final class BezelColor
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
        if (!isset($this->settings->bezelColor)) {
            return;
        }

        $backgroundColor = new CssProperty('background-color', $this->settings->bezelColor);

        yield new CssRule('body.x-body #pimcore_body', $backgroundColor);
        yield new CssRule('body.x-body #pimcore_loading.loaded', $backgroundColor);
        yield new CssRule('body.x-body .sf-minitoolbar', $backgroundColor);
        yield new CssRule('body.x-body #pimcore_panel_tabs > .x-panel-bodyWrap > .x-tab-bar', $backgroundColor);
        yield new CssRule('#pimcore_loading.loaded', $backgroundColor);
        yield new CssRule('.x-body .sf-minitoolbar', $backgroundColor);
    }
}
