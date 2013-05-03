<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Entity;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * Customizable product entity repository.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class CustomizableProductRepository extends EntityRepository
{
    /**
     * {@inhertitdoc}
     */
    protected function getQueryBuilder()
    {
        return parent::getQueryBuilder()
            ->select('product, variant, image, option, optionValue, productProperty, property')
            ->leftJoin('product.variants', 'variant')
            ->leftJoin('variant.images', 'image')
            ->leftJoin('product.options', 'option')
            ->leftJoin('option.values', 'optionValue')
            ->leftJoin('product.properties', 'productProperty')
            ->leftJoin('productProperty.property', 'property')
        ;
    }

    /**
     * {@inhertitdoc}
     */
    protected function getAlias()
    {
        return 'product';
    }
}
