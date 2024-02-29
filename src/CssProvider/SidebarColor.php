<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\CssProvider;

use Neusta\Pimcore\BackendBrandingBundle\Attributes\AsCssProvider;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssProperty;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;

#[AsCssProvider]
final class SidebarColor
{
    /**
     * @return iterable<CssRule>
     */
    public function __invoke(string $sidebarColor): iterable
    {
        $backgroundColor = new CssProperty('background-color', $sidebarColor);

        yield new CssRule('#pimcore_sidebar', $backgroundColor);
        yield new CssRule('#pimcore_loading.loaded', $backgroundColor);
        yield new CssRule('.x-body .sf-minitoolbar', $backgroundColor);
    }
}
