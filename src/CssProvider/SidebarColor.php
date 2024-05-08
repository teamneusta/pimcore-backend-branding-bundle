<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\CssProvider;

use Neusta\Pimcore\BackendBrandingBundle\Attributes\AsCssProvider;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssProperty;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;
use Neusta\Pimcore\BackendBrandingBundle\Settings;

#[AsCssProvider]
final class SidebarColor
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
        if (!isset($this->settings->sidebarColor)) {
            return;
        }

        $backgroundColor = new CssProperty('background-color', $this->settings->sidebarColor);

        yield new CssRule('#pimcore_sidebar', $backgroundColor);
        yield new CssRule('#pimcore_loading.loaded', $backgroundColor);
        yield new CssRule('.x-body .sf-minitoolbar', $backgroundColor);
    }
}
