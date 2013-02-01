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
 * Model for product properties.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Property implements PropertyInterface
{
    /**
     * Property id.
     *
     * @var mixed
     */
    protected $id;

    /**
     * Internal name.
     *
     * @var string
     */
    protected $name;

    /**
     * Type.
     * @var string
     */
    protected $type;

    /**
     * Presentation.
     * Displayed to user.
     *
     * @var string
     */
    protected $presentation;

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

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->name;
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
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * {@inheritdoc}
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;
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
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }
}
