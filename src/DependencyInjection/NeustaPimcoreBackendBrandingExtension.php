<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\DependencyInjection;

use Neusta\Pimcore\BackendBrandingBundle\Attributes\AsCssProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

final class NeustaPimcoreBackendBrandingExtension extends ConfigurableExtension
{
    /**
     * @param array<string, mixed> $mergedConfig
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(\dirname(__DIR__, 2) . '/config'));
        $loader->load('services.php');

        $container->setParameter('neusta_pimcore_backend_branding.config', $mergedConfig);

        $container->registerAttributeForAutoconfiguration(
            AsCssProvider::class,
            static function (ChildDefinition $definition, AsCssProvider $attribute): void {
                $definition->addTag('neusta_pimcore_backend_branding.css_provider');
            },
        );
    }
}
