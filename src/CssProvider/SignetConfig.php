<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\CssProvider;

final class SignetConfig
{
    public function __construct(
        public readonly string $url,
        public readonly string $size,
        public readonly string $position,
        public readonly ?string $color = null,
    ) {
    }
}
