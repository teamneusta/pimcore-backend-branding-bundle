<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('neusta_pimcore_backend_branding');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('title')
                    ->beforeNormalization()
                        ->ifString()
                        ->then(fn (string $v) => ['login' => $v, 'backend' => $v])
                    ->end()
                    ->children()
                        ->scalarNode('login')->defaultNull()->end()
                        ->scalarNode('backend')->defaultNull()->end()
                    ->end()
                ->end()
                ->scalarNode('favIcon')->end()
                ->arrayNode('login')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('color')
                            ->info('Configures: pimcore_admin.branding.color_login_screen')
                            ->defaultNull()
                        ->end()
                        ->booleanNode('invertColors')
                            ->info('Configures: pimcore_admin.branding.login_screen_invert_colors')
                            ->defaultFalse()
                        ->end()
                        ->scalarNode('image')
                            ->info('Configures: pimcore_admin.branding.login_screen_custom_image')
                            ->defaultValue('')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('backend')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('color')
                            ->info('Configures: pimcore_admin.branding.color_admin_interface')
                            ->defaultNull()
                        ->end()
                        ->scalarNode('backgroundColor')
                            ->info('Configures: pimcore_admin.branding.color_admin_interface_background')
                            ->defaultNull()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('bezelColor')->end()
                ->scalarNode('sidebarColor')->end()
                ->arrayNode('signet')
                    ->beforeNormalization()
                        ->ifString()
                        ->then(fn (string $v) => ['url' => $v, 'size' => '70%', 'position' => 'center'])
                    ->end()
                    ->children()
                        ->scalarNode('url')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('size')->defaultValue('70%')->end()
                        ->scalarNode('position')->defaultValue('center')->end()
                        ->scalarNode('color')->defaultNull()->end()
                    ->end()
                ->end()
                ->arrayNode('tabBarIcon')
                    ->beforeNormalization()
                        ->ifString()
                        ->then(fn (string $v) => ['url' => $v])
                    ->end()
                    ->children()
                        ->scalarNode('url')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('size')->defaultNull()->end()
                        ->scalarNode('position')->defaultNull()->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
