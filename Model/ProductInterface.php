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
     * Get SKU, which stands for Stock Keeping Unit.
     * An unique identifier that identifies the product in store.
     *
     * @return string
     */
    public function getSku();

    /**
     * Set product SKU.
     *
     * @param string $sku The product SKU
     */
    public function setSku($sku);

    /**
     * Get product name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set product name.
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Get permalink/slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set the permalink.
     *
     * @param string $slug
     */
    public function setSlug($slug);

    /**
     * Get product name.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set product description.
     *
     * @param string $description
     */
    public function setDescription($description);

    /**
     * Check whether the product is available.
     */
    public function isAvailable();

    /**
     * Return available on.
     *
     * @return \DateTime
     */
    public function getAvailableOn();

    /**
     * Set available on.
     *
     * @param \DateTime $availableOn
     */
    public function setAvailableOn(\DateTime $availableOn);

    public function getMetaKeywords();
    public function setMetaKeywords($metaKeywords);
    public function getMetaDescription();
    public function setMetaDescription($metaDescription);

    /**
     * Make available now.
     */
    public function incrementAvailableOn();

    /**
     * Get creation time.
     *
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * Set creation time.
     *
     * @param DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Set creation time to now.
     */
    public function incrementCreatedAt();

    /**
     * Get the time of last update.
     *
     * @return DateTime
     */
    public function getUpdatedAt();

    /**
     * Set last time update.
     *
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Set last update time to now.
     */
    public function incrementUpdatedAt();

    /**
     * Is product deleted?
     *
     * @return Boolean
     */
    public function isDeleted();

    /**
     * Get the time of deletion.
     * Used for soft removal of product.
     *
     * @return DateTime
     */
    public function getDeletedAt();

    /**
     * Set deletion time.
     *
     * @param DateTime $deletedAt
     */
    public function setDeletedAt(\DateTime $deletedAt);

    /**
     * Set deletion time to now.
     */
    public function incrementDeletedAt();
}
