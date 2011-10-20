<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Compiler pass that registers all sorters.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class RegisterSortersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('sylius_assortment.sorting')) {
            return;
        }
        
        $definition = $container->getDefinition('sylius_assortment.sorting');
        foreach ($container->findTaggedServiceIds('sylius_assortment.sorter') as $id => $attributes) {
            $definition->addMethodCall('registerSorter', array(new Reference($id)));
        }
    }
}
