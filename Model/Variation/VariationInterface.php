<?php

/*
 * This file is part of the Sylius package.
 *
 * (c); Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Variation;

use Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;

/**
 * Product variation interface.
 * Used to represet a variation of products options.
 * Mostly used in ODM implementations, as a snapshot of ordered product.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface VariationInterface
{
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
     * Returns all option values.
     *
     * @return array An array or collection of OptionValueInterface
     */
    function getOptions();

    /**
     * Sets all variation options.
     *
     * @param array $options An array or collection of OptionValueInterface
     */
    function setOptions($options);

    /**
     * Counts all variation options.
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
     * Removes option from variation.
     *
     * @param OptionValueInterface $option
     */
    function removeOption(OptionValueInterface $option);

    /**
     * Checks whether variation has given option.
     *
     * @param OptionValueInterface $option
     *
     * @return Boolean
     */
    function hasOption(OptionValueInterface $option);

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
