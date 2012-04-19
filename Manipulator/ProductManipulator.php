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

use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\AssortmentBundle\Model\ProductManagerInterface;

/**
 * Product manipulator.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductManipulator implements ProductManipulatorInterface
{
    /**
     * Product manager.
     *
     * @var ProductManagerInterface
     */
    protected $productManager;

    /**
     * Constructor.
     *
     * @param ProductManagerInterface $productManager
     */
    public function __construct(ProductManagerInterface $productManager)
    {
        $this->productManager = $productManager;
    }

    /**
     * {@inheritdoc}
     */
    public function create(ProductInterface $product)
    {
        $this->productManager->persistProduct($product);
    }

    /**
     * {@inheritdoc}
     */
    public function update(ProductInterface $product)
    {
        $this->productManager->persistProduct($product);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ProductInterface $product)
    {
        $this->productManager->removeProduct($product);
    }

    /**
     * {@inheritdoc}
     */
    public function duplicate(ProductInterface $product)
    {
        return $this->productManager->duplicateProduct($product);
    }
}
