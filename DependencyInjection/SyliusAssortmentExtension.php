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

        $driver = $config['driver'];

        $this->loadDriver($driver, $config, $container, $loader);

        $container->setParameter('sylius_assortment.driver', $driver);
        $container->setParameter('sylius_assortment.engine', $config['engine']);

        $this->mapClassParameters($config['classes'], $container);
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
            throw new \InvalidArgumentException(sprintf('Driver "%s" is unsupported by SyliusAssortmentBundle', $driver));
        }

        $classes = $config['classes'];
        $loader->load(sprintf('driver/%s.xml', $driver));

        $loader->load('products.xml');

        if (!empty($classes['variant'])) {
            $loader->load('variants.xml');
        }

        if (!empty($classes['option'])) {
            $loader->load('options.xml');
        }

        if (!empty($classes['property'])) {
            $loader->load('properties.xml');
        }

        if (!empty($classes['prototype'])) {
            $loader->load('prototypes.xml');
        }
    }

    /**
     * Remap class parameters.
     *
     * @param array            $classes
     * @param ContainerBuilder $container
     */
    protected function mapClassParameters(array $classes, ContainerBuilder $container)
    {
        foreach ($classes as $model => $serviceClasses) {
            foreach ($serviceClasses as $service => $class) {
                $service = $service === 'form' ? 'form.type' : $service;
                $container->setParameter(sprintf('sylius_assortment.%s.%s.class', $service, $model), $class);
            }
        }
    }
}
