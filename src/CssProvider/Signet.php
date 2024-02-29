<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\CssProvider;

use Neusta\Pimcore\BackendBrandingBundle\Attributes\AsCssProvider;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssProperty;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;

#[AsCssProvider]
final class Signet
{
    /**
     * @return iterable<CssRule>
     */
    public function __invoke(SignetConfig $signet): iterable
    {
        yield $signetRule = new CssRule('#pimcore_signet',
            new CssProperty('background-image', $signet->url, isUrl: true),
            new CssProperty('background-size', $signet->size),
            new CssProperty('background-position', $signet->position),
        );

        if (isset($signet->color)) {
            $signetRule->setProperty(new CssProperty('background-color', $signet->color, isImportant: true));

            yield new CssRule('#pimcore_avatar',
                new CssProperty('background-color', $signet->color, isImportant: true),
            );
        }
    }
}
