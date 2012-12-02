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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
        $this->variants = new ArrayCollection();
        $this->options = new ArrayCollection();
        $this->properties = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        if (null === $this->masterVariant) {
            throw new \BadMethodCallException('You can\'t access product SKU without master variant being set');
        }

        return $this->masterVariant->getSku();
    }

    /**
     * {@inheritdoc}
     */
    public function setSku($sku)
    {
        if (null === $this->masterVariant) {
            throw new \BadMethodCallException('You can\'t access product SKU without master variant being set');
        }

        $this->masterVariant->setSku($sku);
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

        $this->sku = $masterVariant->getSku();

        $this->masterVariant = $masterVariant;
    }

    /**
     * {@inheritdoc}
     */
    public function isVaried()
    {
        return 0 !== $this->countVariants();
    }

    /**
     * {@inheritdoc}
     */
    public function getVariants()
    {
        return $this->variants->filter(function (VariantInterface $variant) {
            return !$variant->isMaster();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getAvailableVariants()
    {
        return $this->variants->filter(function (VariantInterface $variant) {
            return !$variant->isMaster() && $variant->isAvailable();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function setVariants(Collection $variants)
    {
        $this->variants = $variants;
    }

    /**
     * {@inheritdoc}
     */
    public function countVariants()
    {
        return count($this->getVariants());
    }

    /**
     * {@inheritdoc}
     */
    public function addVariant(VariantInterface $variant)
    {
        if (!$this->hasVariant($variant)) {
            $variant->setProduct($this);
            $this->variants->add($variant);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeVariant(VariantInterface $variant)
    {
        if ($this->hasVariant($variant)) {
            $variant->setProduct(null);
            $this->variants->removeElement($variant);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasVariant(VariantInterface $variant)
    {
        return $this->variants->contains($variant);
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    public function countOptions()
    {
        return $this->options->count();
    }

    /**
     * {@inheritdoc}
     */
    public function setOptions(Collection $options)
    {
        $this->options = $options;
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
    public function addProperty(ProductPropertyInterface $property)
    {
        if (!$this->hasProperty($property)) {
            $property->setProduct($this);
            $this->properties->add($property);
        }
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

    public function countProperties()
    {
        return $this->properties->count();
    }

    /**
     * {@inheritdoc}
     */
    public function removeProperty(ProductPropertyInterface $property)
    {
        if ($this->hasProperty($property)) {
            $property->setProduct(null);
            $this->properties->removeElement($property);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasProperty(ProductPropertyInterface $property)
    {
        return $this->properties->contains($property);
    }

    /**
     * {@inheritdoc}
     */
    public function isAvailable()
    {
        return $this->masterVariant->isAvailable();
    }

    /**
     * {@inheritdoc}
     */
    public function getAvailableOn()
    {
        return $this->masterVariant->getAvailableOn();
    }

    /**
     * {@inheritdoc}
     */
    public function setAvailableOn(\DateTime $availableOn)
    {
        $this->masterVariant->setAvailableOn($availableOn);
    }

    /**
     * {@inheritdoc}
     */
    public function incrementAvailableOn()
    {
        $this->availableOn = new \DateTime("now");
    }
}
