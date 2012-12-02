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

use Doctrine\Common\Collections\Collection;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;
use Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface;
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;

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
    public function getMasterVariant();

    /**
     * Sets master variant.
     *
     * @param VariantInterface $variant
     */
    public function setMasterVariant(VariantInterface $variant);

    /**
     * Has any variants?
     *
     * @return Boolean
     */
    public function isVaried();

    /**
     * Returns all product variants.
     *
     * @return Collection of VariantInterface
     */
    public function getVariants();

    /**
     * Return product variants that are available currently.
     *
     * @return array An array or collection of VariantInterface
     */
    public function getAvailableVariants();

    /**
     * Sets all product variants.
     *
     * @param Collection
     */
    public function setVariants(Collection $variants);

    /**
     * Counts all product variants.
     *
     * @return integer
     */
    public function countVariants();

    /**
     * Adds variant.
     *
     * @param VariantInterface $variant
     */
    public function addVariant(VariantInterface $variant);

    /**
     * Removes variant from product.
     *
     * @param VariantInterface $variant
     */
    public function removeVariant(VariantInterface $variant);

    /**
     * Checks whether product has given variant.
     *
     * @param VariantInterface $variant
     *
     * @return Boolean
     */
    public function hasVariant(VariantInterface $variant);

    /**
     * Returns all product options.
     *
     * @return Collection
     */
    public function getOptions();

    /**
     * Sets all product options.
     *
     * @param Collection $options
     */
    public function setOptions(Collection $options);

    /**
     * Counts all product options.
     *
     * @return integer
     */
    public function countOptions();

    /**
     * Adds option.
     *
     * @param OptionInterface $option
     */
    public function addOption(OptionInterface $option);

    /**
     * Removes option from product.
     *
     * @param OptionInterface $option
     */
    public function removeOption(OptionInterface $option);

    /**
     * Checks whether product has given option.
     *
     * @param OptionInterface $option
     *
     * @return Boolean
     */
    public function hasOption(OptionInterface $option);

    /**
     * Returns all product product properties.
     *
     * @return Collection of ProductPropertyInterface
     */
    public function getProperties();

    /**
     * Sets all product product properties.
     *
     * @param Collection of ProductPropertyInterface
     */
    public function setProperties(Collection $properties);

    /**
     * Counts all product product properties.
     *
     * @return integer
     */
    public function countProperties();

    /**
     * Adds product property.
     *
     * @param ProductPropertyInterface $property
     */
    public function addProperty(ProductPropertyInterface $property);

    /**
     * Removes product property from product.
     *
     * @param ProductPropertyInterface $property
     */
    public function removeProperty(ProductPropertyInterface $property);

    /**
     * Checks whether product has given product property.
     *
     * @param ProductPropertyInterface $property
     *
     * @return Boolean
     */
    public function hasProperty(ProductPropertyInterface $property);
}
