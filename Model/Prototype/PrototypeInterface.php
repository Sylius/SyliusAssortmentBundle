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

use Doctrine\Common\Collections\Collection;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;
use Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface;

/**
 * Used to generate full product form.
 * It simplifies product creation.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface PrototypeInterface
{
    /**
     * Get name, it will be displayed by user only in backend.
     * Can be something like 't-shirt' or 'tv'.
     *
     * @return string
     */
    public function getName();

    /**
     * Set name.
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Returns all prototype properties.
     *
     * @return array An array or collection of PropertyInterface
     */
    public function getProperties();

    /**
     * Sets all prototype properties.
     *
     * @param Collection $properties
     */
    public function setProperties(Collection $properties);

    /**
     * Counts all prototype properties.
     *
     * @return integer
     */
    public function countProperties();

    /**
     * Adds property.
     *
     * @param PropertyInterface $property
     */
    public function addProperty(PropertyInterface $property);

    /**
     * Removes property from prototype.
     *
     * @param PropertyInterface $property
     */
    public function removeProperty(PropertyInterface $property);

    /**
     * Checks whether prototype has given property.
     *
     * @param PropertyInterface $property
     *
     * @return Boolean
     */
    public function hasProperty(PropertyInterface $property);

    /**
     * Returns all prototype options.
     *
     * @return Collection
     */
    public function getOptions();

    /**
     * Sets all prototype options.
     *
     * @param Collection $options
     */
    public function setOptions(Collection $options);

    /**
     * Counts all prototype options.
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
     * Removes option from prototype.
     *
     * @param OptionInterface $option
     */
    public function removeOption(OptionInterface $option);

    /**
     * Checks whether prototype has given option.
     *
     * @param OptionInterface $option
     *
     * @return Boolean
     */
    public function hasOption(OptionInterface $option);

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
}
