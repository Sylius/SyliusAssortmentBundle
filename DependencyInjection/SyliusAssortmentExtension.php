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

use Sylius\Bundle\AssortmentBundle\SyliusAssortmentBundle;
use Sylius\Bundle\ResourceBundle\DependencyInjection\ServiceGenerator;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Assortment dependency injection extension.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class SyliusAssortmentExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();

        $config = $processor->processConfiguration($configuration, $config);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/container'));

        $this->loadDriver($config['driver'], $config, $container, $loader);

        $container->setParameter('sylius_assortment.driver', $config['driver']);
        $container->setParameter('sylius_assortment.engine', $config['engine']);

        $this->remapParametersNamespaces($config['classes'], $container, array(
            'controller'  => 'sylius_assortment.controller.%s.class',
            'manipulator' => 'sylius_assortment.manipulator.%s.class',
            'model'       => 'sylius_assortment.model.%s.class',
        ));

        $this->remapParametersNamespaces($config['classes']['form'], $container, array(
            'type' => 'sylius_assortment.form.type.%s.class'
        ));
    }

    /**
     * Load bundle driver.
     *
     * @param string           $driver
     * @param array            $config
     * @param ContainerBuilder $container
     * @param XmlFileLoader    $loader
     *
     * @throws InvalidArgumentException
     */
    protected function loadDriver($driver, array $config, ContainerBuilder $container, XmlFileLoader $loader)
    {
        if (!in_array($driver, SyliusAssortmentBundle::getSupportedDrivers())) {
            throw new \InvalidArgumentException(sprintf('Driver "%s" is unsupported for this extension', $driver));
        }

        $models = $config['classes']['model'];

        $serviceGenerator = new ServiceGenerator($container);
        $serviceGenerator->generate('sylius_assortment', 'product', $driver, $models['product']);

        $loader->load('products.xml');

        if (!empty($models['variant'])) {
            $loader->load('variants.xml');
            $serviceGenerator->generate('sylius_assortment', 'variant', $driver, $models['variant']);
        }
        if (!empty($models['option'])) {
            $loader->load('options.xml');
            $serviceGenerator->generate('sylius_assortment', 'option', $driver, $models['option']);
        }
        if (!empty($models['property'])) {
            $loader->load('properties.xml');
            $serviceGenerator->generate('sylius_assortment', 'property', $driver, $models['property']);
        }
        if (!empty($models['prototype'])) {
            $loader->load('prototypes.xml');
            $serviceGenerator->generate('sylius_assortment', 'prototype', $driver, $models['prototype']);
        }
    }

    /**
     * Remap parameters.
     *
     * @param array            $config
     * @param ContainerBuilder $container
     * @param array            $map
     */
    protected function remapParameters(array $config, ContainerBuilder $container, array $map)
    {
        foreach ($map as $name => $paramName) {
            if (isset($config[$name])) {
                $container->setParameter($paramName, $config[$name]);
            }
        }
    }

    /**
     * Remap parameter namespaces.
     *
     * @param array            $config
     * @param ContainerBuilder $container
     * @param array            $namespaces
     */
    protected function remapParametersNamespaces(array $config, ContainerBuilder $container, array $namespaces)
    {
        foreach ($namespaces as $ns => $map) {
            if ($ns) {
                if (!isset($config[$ns])) {
                    continue;
                }
                $namespaceConfig = $config[$ns];
            } else {
                $namespaceConfig = $config;
            }
            if (is_array($map)) {
                $this->remapParameters($namespaceConfig, $container, $map);
            } else {
                foreach ($namespaceConfig as $name => $value) {
                    if (null !== $value) {
                        $container->setParameter(sprintf($map, $name), $value);
                    }
                }
            }
        }
    }
}
