<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\CssProvider;

final class TabBarIconConfig
{
    public function __construct(
        public readonly string $url,
        public readonly ?string $size = null,
        public readonly ?string $position = null,
    ) {
    }
}
