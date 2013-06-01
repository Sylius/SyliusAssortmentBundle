<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Product management bundle with highly flexible architecture.
 * Supports simple product catalogs and complex feature-rich stores
 * with options, variants, properties and prototypes.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class SyliusAssortmentBundle extends Bundle
{
    /**
     * Return array with currently supported drivers.
     *
     * @return array
     */
    public static function getSupportedDrivers()
    {
        return array(
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM,
            SyliusResourceBundle::DRIVER_DOCTRINE_MONGODB_ODM
        );
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $interfaces = array(
            'Sylius\Bundle\AssortmentBundle\Model\ProductInterface'                  => 'sylius.model.product.class',
            'Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface'          => 'sylius.model.variant.class',
            'Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface'            => 'sylius.model.option.class',
            'Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface'       => 'sylius.model.option_value.class',
            'Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface'        => 'sylius.model.property.class',
            'Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface' => 'sylius.model.product_property.class',
            'Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface'      => 'sylius.model.prototype.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('sylius_assortment', $interfaces));
    }
}
