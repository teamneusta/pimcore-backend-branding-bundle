<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Neusta\Pimcore\BackendBrandingBundle\Controller\CssController;
use Neusta\Pimcore\BackendBrandingBundle\CssProvider;
use Neusta\Pimcore\BackendBrandingBundle\EventListener\BackendAssetsListener;
use Neusta\Pimcore\BackendBrandingBundle\EventListener\BackendResponseListener;
use Neusta\Pimcore\BackendBrandingBundle\Settings;
use Neusta\Pimcore\BackendBrandingBundle\SettingsFactory;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set(Settings::class)
            ->factory([service(SettingsFactory::class), 'create'])
            ->args(['%kernel.runtime_environment%'])
        ->set(SettingsFactory::class)
            ->arg('$config', param('neusta_pimcore_backend_branding.environments'))
            ->arg('$denormalizer', service('serializer'))
        ->set(BackendAssetsListener::class)
            ->autoconfigure()
            ->arg('$urlGenerator', service('router'))
        ->set(BackendResponseListener::class)
            ->autoconfigure()
            ->arg('$settings', service(Settings::class))
        ->set(CssController::class)
            ->autoconfigure()
            ->arg('$cssProvider', service(CssProvider::class))
        ->set(CssProvider::class)
            ->arg('$providers', tagged_iterator('neusta_pimcore_backend_branding.css_provider'))
        ->load('Neusta\Pimcore\BackendBrandingBundle\CssProvider\\', '../src/CssProvider')
            ->autoconfigure()
            ->autowire()
    ;
};
