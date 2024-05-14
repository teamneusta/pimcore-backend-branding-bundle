<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\DependencyInjection;

use Neusta\Pimcore\BackendBrandingBundle\Attributes\AsCssProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

final class NeustaPimcoreBackendBrandingExtension extends ConfigurableExtension implements PrependExtensionInterface
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

    public function prepend(ContainerBuilder $container): void
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $configs = $container->getParameterBag()->resolveValue($configs);
        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->prependExtensionConfig('pimcore_admin', [
            'branding' => [
                'color_admin_interface' => $config['backend']['color'],
                'color_admin_interface_background' => $config['backend']['background_color'],
                'color_login_screen' => $config['login']['color'],
                'login_screen_custom_image' => $config['login']['image'],
                'login_screen_invert_colors' => $config['login']['invert_colors'],
            ],
        ]);
    }
}
