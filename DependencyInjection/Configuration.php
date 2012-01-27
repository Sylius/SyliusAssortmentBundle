<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle.
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     * 
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sylius_assortment');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')->cannotBeOverwritten()->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('engine')->defaultValue('twig')->end()
            ->end();

        $this->addClassesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds `classes` section.
     * 
     * @param ArrayNodeDefinition $node
     */
    private function addClassesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('classes')
                    ->isRequired()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('model')
                            ->isRequired()
                            ->children()
                                ->scalarNode('product')->isRequired()->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                        ->arrayNode('controller')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('backend')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('product')->defaultValue('Sylius\Bundle\\AssortmentBundle\\Controller\Backend\\ProductController')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('frontend')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('product')->defaultValue('Sylius\Bundle\\AssortmentBundle\\Controller\Frontend\\ProductController')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('type')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('product')->defaultValue('Sylius\Bundle\\AssortmentBundle\\Form\\Type\\ProductFormType')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('manipulator')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('product')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Manipulator\\ProductManipulator')->end()
                            ->end()
                        ->end()
                        ->arrayNode('inflector')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('slugizer')->defaultValue('Sylius\Bundle\\AssortmentBundle\\Inflector\\Slugizer')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
