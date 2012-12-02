<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Prototype;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;
use Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface;

/**
 * Default prototype implementation.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Prototype implements PrototypeInterface
{
    /**
     * Id.
     *
     * @var mixed
     */
    protected $id;

    /**
     * Name.
     *
     * @var string
     */
    protected $name;

    /**
     * Product properties.
     *
     * @var array
     */
    protected $properties;

    /**
     * Product options.
     *
     * @var array
     */
    protected $options;

    /**
     * Creation time.
     *
     * @var DateTime
     */
    protected $createdAt;

    /**
     * Last update time.
     *
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->options = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * {@inheritdoc}
     */
    public function setProperties(Collection $properties)
    {
        $this->properties = $properties;
    }

    /**
     * {@inheritdoc}
     */
    public function countProperties()
    {
        return $this->properties->count();
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

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function setOptions(Collection $options)
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function countOptions()
    {
        return $this->options->count();
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
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function incrementCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function incrementUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }
}
