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
use Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface;
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;

/**
 * Default model implementation of CustomizableProductInterface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class CustomizableProduct extends Product implements CustomizableProductInterface
{
    /**
     * Master product variant.
     *
     * @var VariantInterface
     */
    protected $masterVariant;

    /**
     * Product variants.
     *
     * @var array
     */
    protected $variants;

    /**
     * Product options.
     *
     * @var array
     */
    protected $options;

    /**
     * Product property values.
     *
     * @var array An array of ProductPropertyInterface objects
     */
    protected $properties;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->variants = array();
        $this->options = array();
        $this->properties = array();
    }

    /**
     * {@inheritdoc}
     */
    public function getMasterVariant()
    {
        return $this->masterVariant;
    }

    /**
     * {@inheritdoc}
     */
    public function setMasterVariant(VariantInterface $masterVariant)
    {
        $masterVariant->setProduct($this);
        $masterVariant->setMaster(true);
        $masterVariant->setSku($this->sku);

        $this->masterVariant = $masterVariant;
    }

    /**
     * {@inheritdoc}
     */
    public function getVariants()
    {
        return array_filter($this->variants, function (VariantInterface $variant) {
            return !$variant->isMaster();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function setVariants($variants)
    {
        $this->variants = $variants;
    }

    /**
     * {@inheritdoc}
     */
    public function countVariants()
    {
        return count($this->variants);
    }

    /**
     * {@inheritdoc}
     */
    public function addVariant(VariantInterface $variant)
    {
        if (!$this->hasVariant($variant)) {
            $this->variants[] = $variant;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeVariant(VariantInterface $variant)
    {
        if ($this->hasVariant($variant)) {
            $key = array_search($variant, $this->variants);
            unset($variants[$key]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasVariant(VariantInterface $variant)
    {
        return in_array($variant, $this->variants);
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
    public function addProperty(ProductPropertyInterface $property)
    {
        if (!$this->hasProperty($property)) {
            $this->properties[] = $property;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeProperty(ProductPropertyInterface $property)
    {
        if ($this->hasProperty($property)) {
            $key = array_search($property, $this->properties);
            unset($properties[$key]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasProperty(ProductPropertyInterface $property)
    {
        return in_array($property, $this->properties);
    }
}
