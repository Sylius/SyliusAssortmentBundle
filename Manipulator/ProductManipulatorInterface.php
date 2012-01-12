<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Manipulator;

use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;

/**
 * Product manipulator interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface ProductManipulatorInterface
{
    /**
     * Creates a product.
     *
     * @param ProductInterface $product
     */
    function create(ProductInterface $product);

    /**
     * Updates a product.
     *
     * @param ProductInterface $product
     */
    function update(ProductInterface $product);

    /**
     * Deletes a product.
     *
     * @param ProductInterface $product
     */
    function delete(ProductInterface $product);
}
