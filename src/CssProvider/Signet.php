<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\CssProvider;

use Neusta\Pimcore\BackendBrandingBundle\Attributes\AsCssProvider;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssProperty;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;
use Neusta\Pimcore\BackendBrandingBundle\Settings;

#[AsCssProvider]
final class Signet
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
        if (!isset($this->settings->signet)) {
            return;
        }

        yield $signetRule = new CssRule('#pimcore_signet',
            new CssProperty('background-image', $this->settings->signet->url, isUrl: true),
            new CssProperty('background-size', $this->settings->signet->size),
            new CssProperty('background-position', $this->settings->signet->position),
        );

        if (isset($this->settings->signet->color)) {
            $signetRule->setProperty(new CssProperty('background-color', $this->settings->signet->color, isImportant: true));

            yield new CssRule('#pimcore_avatar',
                new CssProperty('background-color', $this->settings->signet->color, isImportant: true),
            );
        }
    }
}
