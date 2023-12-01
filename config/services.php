<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Neusta\Pimcore\BackendBrandingBundle\Controller\CssController;
use Neusta\Pimcore\BackendBrandingBundle\Controller\JsController;
use Neusta\Pimcore\BackendBrandingBundle\EventListener\BackendAssetsListener;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set(BackendAssetsListener::class)
            ->autoconfigure()
            ->arg('$urlGenerator', service('router'))
        ->set(CssController::class)
            ->autoconfigure()
            ->arg('$env', '%kernel.runtime_environment%')
            ->arg('$config', param('neusta_pimcore_backend_branding.environments'))
        ->set(JsController::class)
            ->autoconfigure()
            ->arg('$env', '%kernel.runtime_environment%')
            ->arg('$config', param('neusta_pimcore_backend_branding.environments'))
    ;
};
