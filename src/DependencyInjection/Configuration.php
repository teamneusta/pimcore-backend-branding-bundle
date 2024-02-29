<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('neusta_pimcore_backend_branding');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->fixXmlConfig('environment')
            ->children()
                ->arrayNode('environments')
                    ->normalizeKeys(false)
                    ->useAttributeAsKey('name')
                    ->arrayPrototype()
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
                            ->scalarNode('bezelColor')->end()
                            ->scalarNode('sidebarColor')->end()
                            ->append($this->createBackgroundImageNode('signet', '70%', 'center'))
                            ->append($this->createBackgroundImageNode('tabBarIcon'))
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

    private function createBackgroundImageNode(
        string $name,
        string $defaultSize = null,
        string $defaultPosition = null,
    ): ArrayNodeDefinition {
        return (new ArrayNodeDefinition($name))
            ->beforeNormalization()
                ->ifString()
                ->then(fn (string $v) => ['url' => $v, 'size' => $defaultSize, 'position' => $defaultPosition])
            ->end()
            ->children()
                ->scalarNode('url')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('size')->defaultValue($defaultSize)->end()
                ->scalarNode('position')->defaultValue($defaultPosition)->end()
            ->end()
        ;
    }
}
