<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Neusta\Pimcore\BackendBrandingBundle\Controller\CssController;
use Neusta\Pimcore\BackendBrandingBundle\Controller\JsController;
use Neusta\Pimcore\BackendBrandingBundle\CssProvider;
use Neusta\Pimcore\BackendBrandingBundle\EventListener\BackendAssetsListener;
use Neusta\Pimcore\BackendBrandingBundle\EventListener\BackendResponseListener;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set(BackendAssetsListener::class)
            ->autoconfigure()
            ->arg('$urlGenerator', service('router'))
        ->set(BackendResponseListener::class)
            ->autoconfigure()
            ->arg('$env', '%kernel.runtime_environment%')
            ->arg('$config', param('neusta_pimcore_backend_branding.environments'))
        ->set(CssController::class)
            ->autoconfigure()
            ->arg('$env', '%kernel.runtime_environment%')
            ->arg('$config', param('neusta_pimcore_backend_branding.environments'))
            ->arg('$cssProvider', service(CssProvider::class))
        ->set(JsController::class)
            ->autoconfigure()
            ->arg('$env', '%kernel.runtime_environment%')
            ->arg('$config', param('neusta_pimcore_backend_branding.environments'))
        ->set(CssProvider::class)
            ->autoconfigure()
            ->arg('$providers', tagged_iterator('neusta_pimcore_backend_branding.css_provider'))
        ->load('Neusta\Pimcore\BackendBrandingBundle\CssProvider\\', '../src/CssProvider')
            ->autoconfigure()
            ->exclude('../src/CssProvider/*Config.php')
    ;
};
