<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Entity\Prototype;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Bundle\AssortmentBundle\Model\Option\Optioninterface;
use Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface;
use Sylius\Bundle\AssortmentBundle\Model\Prototype\Prototype as BasePrototype;

/**
 * Prototype entity.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Prototype extends BasePrototype
{
    /**
     * Overriding constructor to initialize collections.
     */
    public function __construct()
    {
        parent::__construct();

        $this->properties = new ArrayCollection();
        $this->options = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function addOption(OptionInterface $option)
    {
        if (!$this->hasOption($option)) {
            $this->options->add($option);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeOption(OptionInterface $option)
    {
        if ($this->hasOption($option)) {
            $this->options->removeElement($option);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasOption(OptionInterface $option)
    {
        return $this->options->contains($option);
    }

    /**
     * {@inheritdoc}
     */
    public function addProperty(PropertyInterface $property)
    {
        if (!$this->hasProperty($property)) {
            $this->properties->add($property);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeProperty(PropertyInterface $property)
    {
        if ($this->hasProperty($property)) {
            $this->properties->removeElement($property);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasProperty(PropertyInterface $property)
    {
        return $this->properties->contains($property);
    }
}
