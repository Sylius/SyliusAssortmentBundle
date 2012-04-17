<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Manipulator;

use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantManagerInterface;

/**
 * Variant manipulator.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantManipulator implements VariantManipulatorInterface
{
    /**
     * Variant manager.
     *
     * @var VariantManagerInterface
     */
    protected $variantManager;

    /**
     * Constructor.
     *
     * @param VariantManagerInterface $variantManager
     */
    public function __construct(VariantManagerInterface $variantManager)
    {
        $this->variantManager = $variantManager;
    }

    /**
     * {@inheritdoc}
     */
    public function create(VariantInterface $variant)
    {
        $this->variantManager->persistVariant($variant);
    }

    /**
     * {@inheritdoc}
     */
    public function update(VariantInterface $variant)
    {
        $this->variantManager->persistVariant($variant);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(VariantInterface $variant)
    {
        $this->variantManager->removeVariant($variant);
    }
}
