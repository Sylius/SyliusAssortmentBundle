<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Option;

/**
 * Product option default implementation.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Option implements OptionInterface
{
    /**
     * Property id.
     *
     * @var mixed
     */
    protected $id;

    /**
     * Internal name.
     * See description in interface.
     *
     * @var string
     */
    protected $name;

    /**
     * Presentation.
     * Displayed to user.
     *
     * @var string
     */
    protected $presentation;

    /**
     * Values that option can have.
     *
     * @var array
     */
    protected $values;

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
        $this->values = array();
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
    public function getValues()
    {
        return $this->values;
    }

    /**
     * {@inheritdoc}
     */
    public function setValues($values)
    {
        $this->values = $values;
    }

    /**
     * {@inheritdoc}
     */
    public function countValues()
    {
        return count($this->values);
    }

    /**
     * {@inheritdoc}
     */
    public function addValue(OptionValueInterface $value)
    {
        if (!$this->hasValue($value)) {
            $value->setOption($this);
            $this->values[] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeValue(OptionValueInterface $value)
    {
        if ($this->hasValue($value)) {
            $value->setOption(null);
            $key = array_search($value, $this->values);
            unset($this->values[$key]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasValue(OptionValueInterface $value)
    {
        return in_array($value, $this->values);
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

