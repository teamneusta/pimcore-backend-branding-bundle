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
            ->fixXmlConfig('environment')
            ->children()
                ->arrayNode('environments')
                    ->normalizeKeys(false)
                    ->useAttributeAsKey('name')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('bezelColor')->end()
                            ->arrayNode('signet')
                                ->beforeNormalization()
                                    ->ifString()
                                    ->then(fn (string $v) => ['url' => $v, 'size' => '70%', 'position' => 'center'])
                                ->end()
                                ->children()
                                    ->scalarNode('url')->isRequired()->cannotBeEmpty()->end()
                                    ->scalarNode('size')->defaultValue('70%')->end()
                                    ->scalarNode('position')->defaultValue('center')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
