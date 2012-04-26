<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model;

use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;

/**
 * Default model implementation of FluidProductInterface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FluidProduct extends Product implements FluidProductInterface
{
    /**
     * Product options.
     *
     * @var array
     */
    protected $options;

    /**
     * Product property values.
     *
     * @var array
     */
    protected $properties;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->options = array();
        $this->properties = array();
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
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function countOptions()
    {
        return count($this->options);
    }

    /**
     * {@inheritdoc}
     */
    public function addOption(OptionInterface $option)
    {
        if (!$this->hasOption($option)) {
            $this->options[] = $option;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeOption(OptionInterface $option)
    {
        if ($this->hasOption($option)) {
            $key = array_search($option, $this->options);
            unset($options[$key]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasOption(OptionInterface $option)
    {
        return in_array($option, $this->options);
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
    public function getProperty($property)
    {
        if ($this->hasProperty($property)) {
            return $this->properties[$property];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setProperty($property, $value)
    {
        $this->properties[$property] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function addProperty($property, $value)
    {
        if (!$this->hasProperty($property)) {
            $this->properties[$property] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeProperty($property)
    {
        if ($this->hasProperty($property)) {
            unset($this->properties[$property]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasProperty($property)
    {
        return array_key_exists($property, $this->properties);
    }
}
