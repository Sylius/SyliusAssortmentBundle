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

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\AssortmentBundle\Model\ProductManager as BaseProductManager;
use Sylius\Bundle\AssortmentBundle\Sorting\SorterInterface;

/**
 * ORM driver product manager.
 * It handles model persistence with Doctrine ORM.
 * Also creates proper paginator instance for this driver.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductManager extends BaseProductManager
{
    /**
     * Entity manager.
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Product entity repository.
     *
     * @var EntityRepository
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param EntityManager $entityManager
     * @param string        $class
     */
    public function __construct(EntityManager $entityManager, $class)
    {
        parent::__construct($class);

        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository($this->getClass());
    }

    /**
     * {@inheritdoc}
     */
    public function createProduct()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * {@inheritdoc}
     */
    public function createPaginator(SorterInterface $sorter = null, $filterDeleted = true)
    {
        $queryBuilder = $this->repository->createQueryBuilder('p');

        if (null !== $sorter) {
            $sorter->sort($queryBuilder);
        }

        if (!$filterDeleted) {
            $this->entityManager->getFilters()->disable('softdeleteable');
        }

        return new Pagerfanta(new DoctrineORMAdapter($queryBuilder->getQuery()));
    }

    /**
     * {@inheritdoc}
     */
    public function persistProduct(ProductInterface $product)
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeProduct(ProductInterface $product)
    {
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function duplicateProduct(ProductInterface $product)
    {
        if ($product instanceof CustomizableProductInterface) {
            throw new \BadMethodCall('Duplicate currently does not support customizable products');
        }

        $duplicatedProduct = clone $product;

        $duplicatedProduct->setId(null);
        $duplicatedProduct->setName('Duplicate of '.$product->getName());

        $this->persistProduct($duplicatedProduct);

        return $duplicatedProduct;
    }

    /**
     * {@inheritdoc}
     */
    public function findProduct($id, $filterDeleted = true)
    {
        if (!$filterDeleted) {
            $this->entityManager->getFilters()->disable('softdeleteable');
        }

        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findProductBy(array $criteria, $filterDeleted = true)
    {
        if (!$filterDeleted) {
            $this->entityManager->getFilters()->disable('softdeleteable');
        }

        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findProducts($filterDeleted = true)
    {
        if (!$filterDeleted) {
            $this->entityManager->getFilters()->disable('softdeleteable');
        }

        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findProductsBy(array $criteria, $filterDeleted = true)
    {
        if (!$filterDeleted) {
            $this->entityManager->getFilters()->disable('softdeleteable');
        }

        return $this->repository->findBy($criteria);
    }
}
