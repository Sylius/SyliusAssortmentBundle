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

/**
 * Default model implementation of CustomizableProductInterface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
abstract class CustomizableProduct extends Product implements CustomizableProductInterface
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
        $this->masterVariant = $masterVariant;
    }

    /**
     * {@inheritdoc}
     */
    public function getVariants()
    {
        return $variants;
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
        return in_array($variant, $variants);
    }
}
