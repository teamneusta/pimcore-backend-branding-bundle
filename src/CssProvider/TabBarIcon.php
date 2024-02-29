<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\CssProvider;

use Neusta\Pimcore\BackendBrandingBundle\Attributes\AsCssProvider;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssProperty;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;

#[AsCssProvider]
final class TabBarIcon
{
    /**
     * @return iterable<CssRule>
     */
    public function __invoke(TabBarIconConfig $tabBarIcon): iterable
    {
        $tabBarIconRule = new CssRule('#pimcore_panel_tabs > .x-panel-bodyWrap > .x-tab-bar',
            new CssProperty('background-image', $tabBarIcon->url, isUrl: true),
        );

        if (isset($tabBarIcon->size)) {
            $tabBarIconRule->setProperty(new CssProperty('background-size', $tabBarIcon->size));
        }

        if (isset($tabBarIcon->position)) {
            $tabBarIconRule->setProperty(new CssProperty('background-position', $tabBarIcon->position));
        }

        yield $tabBarIconRule;
    }
}
