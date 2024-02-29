<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\CssProvider;

use Neusta\Pimcore\BackendBrandingBundle\Attributes\AsCssProvider;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssProperty;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;

#[AsCssProvider]
final class BezelColor
{
    /**
     * @return iterable<CssRule>
     */
    public function __invoke(string $bezelColor): iterable
    {
        $backgroundColor = new CssProperty('background-color', $bezelColor);

        yield new CssRule('body.x-body #pimcore_body', $backgroundColor);
        yield new CssRule('body.x-body #pimcore_loading.loaded', $backgroundColor);
        yield new CssRule('body.x-body .sf-minitoolbar', $backgroundColor);
        yield new CssRule('body.x-body #pimcore_panel_tabs > .x-panel-bodyWrap > .x-tab-bar', $backgroundColor);
        yield new CssRule('#pimcore_loading.loaded', $backgroundColor);
        yield new CssRule('.x-body .sf-minitoolbar', $backgroundColor);
    }
}
