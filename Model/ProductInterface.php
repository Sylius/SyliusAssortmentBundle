<?php

/*
 * This file is part of the Sylius package.
 *
 * (c); Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model;

/**
 * Product interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface ProductInterface
{
    /**
     * Get product id.
     *
     * @return mixed
     */
    function getId();

    /**
     * Set product id.
     *
     * @param mixed $id
     */
    function setId($id);

    /**
     * Get SKU, which stands for Stock Keeping Unit.
     * An unique identifier that identifies the product in store.
     *
     * @return string
     */
    function getSku();

    /**
     * Set product SKU.
     *
     * @param string $sku The product SKU
     */
    function setSku($sku);

    /**
     * Get product name.
     *
     * @return string
     */
    function getName();

    /**
     * Set product name.
     *
     * @param string $name
     */
    function setName($name);

    /**
     * Get permalink/slug.
     *
     * @return string
     */
    function getSlug();

    /**
     * Set the permalink.
     *
     * @param string $slug
     */
    function setSlug($slug);

    /**
     * Get product name.
     *
     * @return string
     */
    function getDescription();

    /**
     * Set product description.
     *
     * @param string $description
     */
    function setDescription($description);

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

    /**
     * Is product deleted?
     *
     * @return Boolean
     */
    function isDeleted();

    /**
     * Get the time of deletion.
     * Used for soft removal of product.
     *
     * @return DateTime
     */
    function getDeletedAt();

    /**
     * Set deletion time.
     *
     * @param DateTime $deletedAt
     */
    function setDeletedAt(\DateTime $deletedAt);

    /**
     * Set deletion time to now.
     */
    function incrementDeletedAt();
}
