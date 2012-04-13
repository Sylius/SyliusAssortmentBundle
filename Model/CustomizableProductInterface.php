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

use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;

/**
 * Customizable product interface.
 * Should be implemented by models that support variants, options and properties.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface CustomizableProductInterface extends ProductInterface
{
    /**
     * Returns master variant.
     *
     * @return VariantInterface
     */
    function getMasterVariant();

    /**
     * Sets master variant.
     *
     * @param VariantInterface $variant
     */
    function setMasterVariant(VariantInterface $variant);

    /**
     * Returns all product variants.
     *
     * @return array An array or collection of VariantInterface
     */
    function getVariants();

    /**
     * Sets all product variants.
     *
     * @param array $variants An array or collection of VariantInterface
     */
    function setVariants($variants);

    /**
     * Counts all product variants.
     *
     * @return integer
     */
    function countVariants();

    /**
     * Adds variant.
     *
     * @param VariantInterface $variant
     */
    function addVariant(VariantInterface $variant);

    /**
     * Removes variant from product.
     *
     * @param VariantInterface $variant
     */
    function removeVariant(VariantInterface $variant);

    /**
     * Checks whether product has given variant.
     *
     * @param VariantInterface $variant
     *
     * @return Boolean
     */
    function hasVariant(VariantInterface $variant);

    /**
     * Returns all product options.
     *
     * @return array An array or collection of OptionInterface
     */
    function getOptions();

    /**
     * Sets all product options.
     *
     * @param array $options An array or collection of OptionInterface
     */
    function setOptions($options);

    /**
     * Counts all product options.
     *
     * @return integer
     */
    function countOptions();

    /**
     * Adds option.
     *
     * @param OptionInterface $option
     */
    function addOption(OptionInterface $option);

    /**
     * Removes option from product.
     *
     * @param OptionInterface $option
     */
    function removeOption(OptionInterface $option);

    /**
     * Checks whether product has given option.
     *
     * @param OptionInterface $option
     *
     * @return Boolean
     */
    function hasOption(OptionInterface $option);
}
