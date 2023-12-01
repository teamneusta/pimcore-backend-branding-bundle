<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Pimcore\Extension\Bundle\Traits\PackageVersionTrait;

final class NeustaPimcoreBackendBrandingBundle extends AbstractPimcoreBundle
{
    use PackageVersionTrait;

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
