<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Builder;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;

/**
 * Product builder with fluent interface.
 *
 * Usage example:
 *
 * <code>
 * <?php
 * $this->get('sylius.product_builder')
 *     ->create('Github mug')
 *     ->setDescription("Coffee. Tea. Coke. Water. Let's face it — humans need to drink liquids")
 *     ->setPrice(12.00)
 *     ->addProperty('collection', 2013)
 *     ->addOption('size', array('S', 'M', 'L'))
 *     ->save()
 *    ;
 * </code>
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class ProductBuilder
{
    /**
     * @var ProductInterface
     */
    protected $product;

    /**
     * @var ObjectManager
     */
    protected $productManager;

    /**
     * @var ObjectRepository
     */
    protected $productRepository;

    /**
     * @var ObjectRepository
     */
    protected $propertyRepository;

    /**
     * @var ObjectRepository
     */
    protected $productPropertyRepository;

    /**
     * @var ObjectRepository
     */
    protected $optionRepository;

    /**
     * @var ObjectRepository
     */
    protected $optionValueRepository;

    public function __construct(
        ObjectManager $productManager,
        ObjectRepository $productRepository,
        ObjectRepository $propertyRepository,
        ObjectRepository $productPropertyRepository,
        ObjectRepository $optionRepository,
        ObjectRepository $optionValueRepository
    )
    {
        $this->productManager = $productManager;
        $this->productRepository = $productRepository;
        $this->propertyRepository = $propertyRepository;
        $this->productPropertyRepository = $productPropertyRepository;
        $this->optionRepository = $optionRepository;
        $this->optionValueRepository = $optionValueRepository;
    }

    public function __call($method, $arguments)
    {
        if (!method_exists($this->product, $method)) {
            throw new \BadMethodCallException(
                sprintf('Product have no %s() method.', $method)
            );
        }

        call_user_func_array(array($this->product, $method), $arguments);

        return $this;
    }

    public function create($name)
    {
        $this->product = $this->productRepository->createNew();

        $this->product->setName($name);

        return $this;
    }

    public function addProperty($name, $value, $presentation = null)
    {
        $property = $this->propertyRepository->findOneBy(array('name' => $name));

        if (null === $property) {
            $property = $this->propertyRepository->createNew();
            $property->setName($name);
            $property->setPresentation(null === $presentation ? $name : $presentation);

            $this->productManager->persist($property);
        }

        $productProperty = $this->productPropertyRepository->createNew();
        $productProperty->setProperty($property);
        $productProperty->setValue($value);

        $this->product->addProperty($productProperty);

        return $this;
    }

    public function addOption($name, array $values, $presentation = null)
    {
        $option = $this->optionRepository->findOneBy(array('name' => $name));

        if (null === $option) {
            $option = $this->optionRepository->createNew();
            $option->setName($name);
            $option->setPresentation(null === $presentation ? $name : $presentation);

            $this->productManager->persist($option);
        }

        foreach ($values as $value) {
            $optionValue = $this->optionValueRepository->createNew();
            $optionValue->setvalue($value);

            $option->addValue($optionValue);
        }

        $this->product->addOption($option);

        return $this;
    }

    public function save()
    {
        $this->productManager->persist($this->product);
        $this->productManager->flush();

        return $this;
    }

    public function get()
    {
        return $this->product;
    }
}
