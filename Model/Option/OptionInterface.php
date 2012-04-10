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
    function getOptionValues();

    /**
     * Sets all option values.
     *
     * @param array $optionValues An array or collection of OptionValueInterface
     */
    function setOptionValues($optionValues);

    /**
     * Counts all option values.
     *
     * @return integer
     */
    function countOptionValues();

    /**
     * Adds option value.
     *
     * @param OptionValueInterface $optionValue
     */
    function addOptionValue(OptionValueInterface $optionValue);

    /**
     * Removes option value.
     *
     * @param OptionValueInterface $optionValue
     */
    function removeOptionValue(OptionValueInterface $optionValue);

    /**
     * Checks whether option has given value.
     *
     * @param OptionValueInterface $optionValue
     *
     * @return Boolean
     */
    function hasOptionValue(OptionValueInterface $optionValue);

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
