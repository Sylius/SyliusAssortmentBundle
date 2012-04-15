<?php

/*
 * This file is part of the Sylius package.
 *
 * (c); Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Prototype;

use Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;

/**
 * Used to generate full product form.
 * It simplifies product creation.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface PrototypeInterface
{
    /**
     * Get prototype id.
     *
     * @return mixed
     */
    function getId();

    /**
     * Set prototype id.
     *
     * @param mixed $id
     */
    function setId($id);

    /**
     * Get name, it will be displayed by user only in backend.
     * Can be something like 't-shirt' or 'tv'.
     *
     * @return string
     */
    function getName();

    /**
     * Set name.
     *
     * @param string $name
     */
    function setName($name);

    /**
     * Returns all prototype properties.
     *
     * @return array An array or collection of PropertyInterface
     */
    function getProperties();

    /**
     * Sets all prototype properties.
     *
     * @param array $properties An array or collection of PropertyInterface
     */
    function setProperties($properties);

    /**
     * Counts all prototype properties.
     *
     * @return integer
     */
    function countProperties();

    /**
     * Adds property.
     *
     * @param PropertyInterface $property
     */
    function addProperty(PropertyInterface $property);

    /**
     * Removes property from prototype.
     *
     * @param PropertyInterface $property
     */
    function removeProperty(PropertyInterface $property);

    /**
     * Checks whether prototype has given property.
     *
     * @param PropertyInterface $property
     *
     * @return Boolean
     */
    function hasProperty(PropertyInterface $property);

    /**
     * Returns all prototype options.
     *
     * @return array An array or collection of OptionInterface
     */
    function getOptions();

    /**
     * Sets all prototype options.
     *
     * @param array $options An array or collection of OptionInterface
     */
    function setOptions($options);

    /**
     * Counts all prototype options.
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
     * Removes option from prototype.
     *
     * @param OptionInterface $option
     */
    function removeOption(OptionInterface $option);

    /**
     * Checks whether prototype has given option.
     *
     * @param OptionInterface $option
     *
     * @return Boolean
     */
    function hasOption(OptionInterface $option);

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

