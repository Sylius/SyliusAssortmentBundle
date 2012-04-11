<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Property;

/**
 * Property manager interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface PropertyManagerInterface
{
    /**
     * Creates new property object.
     *
     * @return PropertyInterface
     */
    function createProperty();

    /**
     * Persists property.
     *
     * @param PropertyInterface $property
     */
    function persistProperty(PropertyInterface $property);

    /**
     * Deletes property.
     *
     * @param PropertyInterface $property
     */
    function removeProperty(PropertyInterface $property);

    /**
     * Finds property by id.
     *
     * @param integer $id
     *
     * @return PropertyInterface
     */
    function findProperty($id);

    /**
     * Finds property by criteria.
     *
     * @param array $criteria
     *
     * @return PropertyInterface
     */
    function findPropertyBy(array $criteria);

    /**
     * Finds all properties.
     *
     * @return array
     */
    function findProperties();

    /**
     * Finds properties by criteria.
     *
     * @param array $criteria
     *
     * @return array
     */
    function findPropertiesBy(array $criteria);

    /**
     * Returns FQCN of property.
     *
     * @return string
     */
    function getClass();
}
