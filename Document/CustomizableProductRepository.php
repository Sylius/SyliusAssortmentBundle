<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Document;

use Sylius\Bundle\ResourceBundle\Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Customizable product document repository.
 *
 * @author Eymen Gunay <eymen@egunay.com>
 */
class CustomizableProductRepository extends DocumentRepository
{
    /**
     * {@inhertitdoc}
     */
    protected function getQueryBuilder()
    {
        return parent::getQueryBuilder()
            ->select('product, variant, option, optionValue, productProperty, property')
            ->leftJoin('product.variants', 'variant')
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
