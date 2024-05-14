<?php declare(strict_types=1);

use Neusta\Pimcore\BackendBrandingBundle\NeustaPimcoreBackendBrandingBundle;
use Pimcore\HttpKernel\BundleCollection\BundleCollection;

final class TestKernel extends Neusta\Pimcore\TestingFramework\Kernel\TestKernel
{
    public function registerBundlesToCollection(BundleCollection $collection): void
    {
        $collection->addBundle(NeustaPimcoreBackendBrandingBundle::class);
    }
}
