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
 * Product builder.
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
     * @var ObjectRepository
     */
    protected $productRepository;

    /**
     * @var ObjectManager
     */
    protected $productManager;

    /**
     * @var ObjectRepository
     */
    protected $propertyRepository;

    /**
     * @var ObjectManager
     */
    protected $propertyManager;

    /**
     * @var ObjectRepository
     */
    protected $productPropertyRepository;

    /**
     * @var ObjectRepository
     */
    protected $optionRepository;

    /**
     * @var ObjectManager
     */
    protected $optionManager;

    /**
     * @var ObjectRepository
     */
    protected $optionValueRepository;

    public function __construct(
        ObjectRepository $productRepository,
        ObjectManager $productManager,
        ObjectRepository $propertyRepository,
        ObjectManager $propertyManager,
        ObjectRepository $productPropertyRepository,
        ObjectRepository $optionRepository,
        ObjectManager $optionManager,
        ObjectRepository $optionValueRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->productManager = $productManager;
        $this->propertyRepository = $propertyRepository;
        $this->propertyManager = $propertyManager;
        $this->productPropertyRepository = $productPropertyRepository;
        $this->optionRepository = $optionRepository;
        $this->optionManager = $optionManager;
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

            $this->propertyManager->persist($property);
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

            $this->optionManager->persist($option);
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
