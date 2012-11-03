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

use Doctrine\Common\Collections\Collection;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\ResourceBundle\Model\ResourceInterface;

/**
 * Product variant interface.
 * It's related only to products that implement CustomizableProductInterface or FluidProductInterface.
 * Allows setting values for different variations of product options.
 * If some products don't need to have such features, they simply have only one master variant.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface VariantInterface extends ResourceInterface
{
    /**
     * Checks whether variant is master.
     *
     * @return Boolean
     */
    function isMaster();

    /**
     * Defines whether variant is master.
     *
     * @param Boolean $master
     */
    function setMaster($master);

    /**
     * Get variant SKU.
     *
     * @return string
     */
    function getSku();

    /**
     * Set variant SKU.
     *
     * @param string $sku
     */
    function setSku($sku);

    /**
     * Get presentation.
     * This should be generated from option values
     * when no other is set.
     *
     * @return string
     */
    function getPresentation();

    /**
     * Set custom presentation.
     *
     * @param string $presentation
     */
    function setPresentation($presentation);

    /**
     * Get generated label for variant choice forms.
     *
     * @return string
     */
    function getLabel();

    /**
     * Get master product.
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
     * Returns all option values.
     *
     * @return Collection of OptionValueInterface
     */
    function getOptions();

    /**
     * Sets all variant options.
     *
     * @param Collection $options
     */
    function setOptions(Collection $options);

    /**
     * Counts all variant options.
     *
     * @return integer
     */
    function countOptions();

    /**
     * Adds option value.
     *
     * @param OptionValueInterface $option
     */
    function addOption(OptionValueInterface $option);

    /**
     * Removes option from variant.
     *
     * @param OptionValueInterface $option
     */
    function removeOption(OptionValueInterface $option);

    /**
     * Checks whether variant has given option.
     *
     * @param OptionValueInterface $option
     *
     * @return Boolean
     */
    function hasOption(OptionValueInterface $option);

    /**
     * Check whether the product is available.
     */
    function isAvailable();

    /**
     * Return available on.
     *
     * @return \DateTime
     */
    function getAvailableOn();

    /**
     * Set available on.
     *
     * @param \DateTime $availableOn
     */
    function setAvailableOn(\DateTime $availableOn);

    /**
     * Make available now.
     */
    function incrementAvailableOn();

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
     * Get the time of deletion.
     * Used for soft removal of variant.
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
