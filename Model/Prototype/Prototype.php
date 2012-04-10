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

/**
 * Default prototype implementation.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Prototype implements PrototypeInterface
{
    /**
     * Product properties.
     *
     * @var array
     */
    protected $properties;

    /**
     * Name.
     *
     * @var string
     */
    protected $name;

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
     * {@inheritdoc}
     */
    public function getProperties()
    {
        return $properties;
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
    public function setId($id)
    {
        $this->id = $id;
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
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    /**
     * {@inheritdoc}
     */
    public function countProperties()
    {
        return count($this->properties);
    }

    /**
     * {@inheritdoc}
     */
    public function addProperty(PropertyInterface $property)
    {
        if (!$this->hasProperty($property)) {
            $this->properties[] = $property;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeProperty(PropertyInterface $property)
    {
        if ($this->hasProperty($property)) {
            $key = array_search($property, $this->properties);
            unset($properties[$key]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasProperty(PropertyInterface $property)
    {
        return in_array($property, $this->properties);
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

