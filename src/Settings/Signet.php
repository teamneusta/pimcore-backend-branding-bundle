<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Settings;

/** @immutable */
final class Signet
{
    public string $url;
    public string $size;
    public string $position;
    public ?string $color;
}
