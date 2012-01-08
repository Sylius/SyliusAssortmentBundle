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

use Sylius\Bundle\AssortmentBundle\Model\ProductManagerInterface;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\AssortmentBundle\Inflector\SlugizerInterface;

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
     * Slugizer inflector.
     *
     * @var SlugizerInterface
     */
    protected $slugizer;

    /**
     * Constructor.
     *
     * @param ProductManagerInterface 	$productManager
     * @param SlugizerInterface 		$slugizer
     */
    public function __construct(ProductManagerInterface $productManager, SlugizerInterface $slugizer)
    {
        $this->productManager = $productManager;
        $this->slugizer = $slugizer;
    }

    /**
     * {@inheritdoc}
     */
    public function create(ProductInterface $product)
    {
        $product->setSlug($this->slugizer->slugize($product->getName()));
        $product->incrementCreatedAt();

        $this->productManager->persistProduct($product);
    }

  	/**
     * {@inheritdoc}
     */
    public function update(ProductInterface $product)
    {
        $product->setSlug($this->slugizer->slugize($product->getName()));
        $product->incrementUpdatedAt();

        $this->productManager->persistProduct($product);
    }

  	/**
     * {@inheritdoc}
     */
    public function delete(ProductInterface $product)
    {
        $this->productManager->removeProduct($product);
    }
}
