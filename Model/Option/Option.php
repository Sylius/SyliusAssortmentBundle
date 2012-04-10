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
     * Product optionValues.
     *
     * @var array
     */
    protected $optionValues;

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
    public function getOptionValues()
    {
        return $this->optionValues;
    }

    /**
     * {@inheritdoc}
     */
    public function setOptionValues($optionValues)
    {
        $this->optionValues = $optionValues;
    }

    /**
     * {@inheritdoc}
     */
    public function countOptionValues()
    {
        return count($this->optionValues);
    }

    /**
     * {@inheritdoc}
     */
    public function addOptionValue(OptionValueInterface $optionValue)
    {
        if (!$this->hasOptionValue($optionValue)) {
            $this->optionValues[] = $optionValue;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeOptionValue(OptionValueInterface $optionValue)
    {
        if ($this->hasOptionValue($optionValue)) {
            $key = array_search($optionValue, $this->optionValues);
            unset($this->optionValues[$key]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasOptionValue(OptionValueInterface $optionValue)
    {
        return in_array($optionValue, $this->optionValues);
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

