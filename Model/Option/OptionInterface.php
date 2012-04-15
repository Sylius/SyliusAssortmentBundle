<?php

/*
 * This file is part of the Sylius package.
 *
 * (c); Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Option;

/**
 * Product option interface.
 *
 * It's meant to be used with CustomizableProductInterface
 * but can be also useful when working with your custom interface
 * extending base ProductInterface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface OptionInterface
{
    /**
     * Get option id.
     *
     * @return mixed
     */
    function getId();

    /**
     * Set option id.
     *
     * @param mixed $id
     */
    function setId($id);

    /**
     * Get internal name.
     *
     * It is used only in backend so you can easily
     * separate similar options for different kind of products.
     * For example "T-Shirt size" and "Box size", both may have
     * presentation "Size", but their internal name should be different.
     *
     * @return string
     */
    function getName();

    /**
     * Set internal name.
     *
     * @param string $name
     */
    function setName($name);

    /**
     * The name displayed to user.
     *
     * @return string
     */
    function getPresentation();

    /**
     * Set presentation.
     *
     * @param string $presentation
     */
    function setPresentation($presentation);

    /**
     * Returns all option values.
     *
     * @return array An array or collection of OptionValueInterface
     */
    function getValues();

    /**
     * Sets all option values.
     *
     * @param array $optionValues An array or collection of OptionValueInterface
     */
    function setValues($optionValues);

    /**
     * Counts all option values.
     *
     * @return integer
     */
    function countValues();

    /**
     * Adds option value.
     *
     * @param OptionValueInterface $optionValue
     */
    function addValue(OptionValueInterface $optionValue);

    /**
     * Removes option value.
     *
     * @param OptionValueInterface $optionValue
     */
    function removeValue(OptionValueInterface $optionValue);

    /**
     * Checks whether option has given value.
     *
     * @param OptionValueInterface $optionValue
     *
     * @return Boolean
     */
    function hasValue(OptionValueInterface $optionValue);

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
