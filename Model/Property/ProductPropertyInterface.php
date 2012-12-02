<?php

/*
 * This file is part of the Sylius package.
 *
 * (c); Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Property;

use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;

/**
 * Product to property relation interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface ProductPropertyInterface
{
    /**
     * Get product.
     *
     * @return ProductInterface
     */
    function getProduct();

    /**
     * Set product.
     *
     * @param ProductInterface or null $product
     */
    function setProduct(ProductInterface $product = null);

    /**
     * Get property.
     *
     * @return PropertyInterface
     */
    function getProperty();

    /**
     * Set property.
     *
     * @param PropertyInterface $property
     */
    function setProperty(PropertyInterface $property);

    /**
     * Get property value.
     *
     * @return mixed
     */
    function getValue();

    /**
     * Set property value.
     *
     * @param mixed $value
     */
    function setValue($value);

    /**
     * Proxy method to access the name from real property.
     *
     * @return string
     */
    function getName();

    /**
     * Proxy method to access the presentation from real property.
     *
     * @return string
     */
    function getPresentation();
}
