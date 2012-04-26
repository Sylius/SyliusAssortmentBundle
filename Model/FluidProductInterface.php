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

use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;

/**
 * Fluid product interface.
 * This interface is used by document based storage drivers.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface FluidProductInterface extends ProductInterface
{
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

    /**
     * Returns all product product properties.
     *
     * @return array
     */
    function getProperties();

    /**
     * Sets all product product properties.
     *
     * @param array $properties
     */
    function setProperties($properties);

    /**
     * Counts all product product properties.
     *
     * @return integer
     */
    function countProperties();

    /**
     * Get property.
     *
     * @param string $property
     */
    function getProperty($property);

    /**
     * Set property.
     *
     * @param string $property
     * @param string $value
     */
    function setProperty($property, $value);

    /**
     * Adds product property.
     *
     * @param string $property
     * @param mixed  $value
     */
    function addProperty($property, $value);

    /**
     * Removes product property from product.
     *
     * @param string $property
     */
    function removeProperty($property);

    /**
     * Checks whether product has given product property.
     *
     * @param string $property
     *
     * @return Boolean
     */
    function hasProperty($property);
}
