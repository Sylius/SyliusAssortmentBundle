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
    public function createPaginator(array $options = array())
    {
        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('p')
            ->from($this->class, 'p')
        ;

        if (isset($options['sorter']) && $options['sorter'] instanceof SorterInterface) {
            $options['sorter']->sort($queryBuilder);
        }

        if (isset($options['deleted']) && $options['deleted']) {
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
    public function findProduct($id, array $options = array())
    {
        if (isset($options['deleted']) && $options['deleted']) {
            $this->entityManager->getFilters()->disable('softdeleteable');
        }

        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findProductBy(array $criteria, array $options = array())
    {
        if (isset($options['deleted']) && $options['deleted']) {
            $this->entityManager->getFilters()->disable('softdeleteable');
        }

        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findProducts(array $options = array())
    {
        if (isset($options['deleted']) && $options['deleted']) {
            $this->entityManager->getFilters()->disable('softdeleteable');
        }

        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findProductsBy(array $criteria, array $options = array())
    {
        if (isset($options['deleted']) && $options['deleted']) {
            $this->entityManager->getFilters()->disable('softdeleteable');
        }

        return $this->repository->findBy($criteria);
    }
}
