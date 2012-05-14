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

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
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
     * {@inheritdoc}
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
                ->booleanNode('api')->defaultFalse()->end()
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
                                ->scalarNode('variant')->defaultValue('')->end()
                                ->scalarNode('option')->defaultValue('')->end()
                                ->scalarNode('option_value')->defaultValue('')->end()
                                ->scalarNode('property')->defaultValue('')->end()
                                ->scalarNode('product_property')->defaultValue('')->end()
                                ->scalarNode('prototype')->defaultValue('')->end()
                            ->end()
                        ->end()
                        ->arrayNode('controller')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('backend')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('product')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Controller\Backend\\ProductController')->end()
                                        ->scalarNode('variant')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Controller\Backend\\VariantController')->end()
                                        ->scalarNode('option')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Controller\Backend\\OptionController')->end()
                                        ->scalarNode('property')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Controller\Backend\\PropertyController')->end()
                                        ->scalarNode('prototype')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Controller\Backend\\PrototypeController')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('frontend')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('product')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Controller\Frontend\\ProductController')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('api')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('product')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Controller\Api\\ProductController')->end()
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
                                        ->scalarNode('product')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\ProductType')->end()
                                        ->scalarNode('product_property')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\ProductPropertyType')->end()
                                        ->scalarNode('option')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\OptionType')->end()
                                        ->scalarNode('option_choice')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\OptionChoiceType')->end()
                                        ->scalarNode('option_value')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\OptionValueType')->end()
                                        ->scalarNode('option_value_choice')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\OptionValueChoiceType')->end()
                                        ->scalarNode('option_value_collection')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\OptionValueCollectionType')->end()
                                        ->scalarNode('property')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\PropertyType')->end()
                                        ->scalarNode('property_choice')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\PropertyChoiceType')->end()
                                        ->scalarNode('prototype')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\PrototypeType')->end()
                                        ->scalarNode('variant')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\VariantType')->end()
                                        ->scalarNode('variant_choice')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\VariantChoiceType')->end()
                                        ->scalarNode('variant_match')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Form\\Type\\VariantMatchType')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('manipulator')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('product')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Manipulator\\ProductManipulator')->end()
                                ->scalarNode('variant')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Manipulator\\VariantManipulator')->end()
                                ->scalarNode('option')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Manipulator\\OptionManipulator')->end()
                                ->scalarNode('property')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Manipulator\\PropertyManipulator')->end()
                                ->scalarNode('prototype')->defaultValue('Sylius\\Bundle\\AssortmentBundle\\Manipulator\\PrototypeManipulator')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
