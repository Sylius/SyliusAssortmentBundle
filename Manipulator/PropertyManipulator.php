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
use Sylius\Bundle\AssortmentBundle\Model\Property\PropertyManagerInterface;

/**
 * Property manipulator.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PropertyManipulator implements PropertyManipulatorInterface
{
    /**
     * Property manager.
     *
     * @var PropertyManagerInterface
     */
    protected $propertyManager;

    /**
     * Constructor.
     *
     * @param PropertyManagerInterface $propertyManager
     */
    public function __construct(PropertyManagerInterface $propertyManager)
    {
        $this->propertyManager = $propertyManager;
    }

    /**
     * {@inheritdoc}
     */
    public function create(PropertyInterface $property)
    {
        $this->propertyManager->persistProperty($property);
    }

    /**
     * {@inheritdoc}
     */
    public function update(PropertyInterface $property)
    {
        $this->propertyManager->persistProperty($property);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(PropertyInterface $property)
    {
        $this->propertyManager->removeProperty($property);
    }
}
