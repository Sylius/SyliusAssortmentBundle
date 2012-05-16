<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Bundle\AssortmentBundle\Model\CustomizableProduct as BaseCustomizableProduct;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;
use Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface;
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;

/**
 * Base customizable product entity.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class CustomizableProduct extends BaseCustomizableProduct
{
    /**
     * Override constructor to initialize collections.
     */
    public function __construct()
    {
        parent::__construct();

        $this->variants = new ArrayCollection();
        $this->options = new ArrayCollection();
        $this->properties = new ArrayCollection();
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
}
