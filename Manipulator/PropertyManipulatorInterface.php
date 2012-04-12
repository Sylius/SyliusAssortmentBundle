<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Manipulator;

use Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface;

/**
 * Property manipulator interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface PropertyManipulatorInterface
{
    /**
     * Creates a property.
     *
     * @param PropertyInterface $property
     */
    function create(PropertyInterface $property);

    /**
     * Updates a property.
     *
     * @param PropertyInterface $property
     */
    function update(PropertyInterface $property);

    /**
     * Deletes a property.
     *
     * @param PropertyInterface $property
     */
    function delete(PropertyInterface $property);
}
