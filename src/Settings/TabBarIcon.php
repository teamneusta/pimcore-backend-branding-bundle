<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Settings;

/** @immutable */
final class TabBarIcon
{
    public string $url;
    public ?string $size;
    public ?string $position;
}
