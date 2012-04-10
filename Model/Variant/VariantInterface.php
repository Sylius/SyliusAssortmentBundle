<?php

/*
 * This file is part of the Sylius package.
 *
 * (c); Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Variant;

use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;

/**
 * Product variant interface.
 * It's related only to products that implement CustomizableProductInterface.
 * Allows setting values for different variations of product options.
 * If some products don't need to have such features, they simply have only one master variant.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface VariantInterface
{
    /**
     * Get variant id.
     *
     * @return mixed
     */
    function getId();

    /**
     * Set variant id.
     *
     * @param mixed $id
     */
    function setId($id);

    /**
     * Get master product.
     *
     * @return ProductInterface
     */
    function getProduct();

    /**
     * Set product.
     *
     * @param ProductInterface $product
     */
    function setProduct(ProductInterface $product);

    /**
     * Get creation time.
     *
     * @return DateTime
     */
    function getCreatedAt();

    /**
     * Set creation time.
     *
     * @param DateTime $createdAt
     */
    function setCreatedAt(\DateTime $createdAt);

    /**
     * Set creation time to now.
     */
    function incrementCreatedAt();

    /**
     * Get the time of last update.
     *
     * @return DateTime
     */
    function getUpdatedAt();

    /**
     * Set last time update.
     *
     * @param DateTime $updatedAt
     */
    function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Set last update time to now.
     */
    function incrementUpdatedAt();
}
