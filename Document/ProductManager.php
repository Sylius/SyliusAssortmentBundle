<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Document;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Pagerfanta\Adapter\DoctrineODMMongoDBAdapter;
use Pagerfanta\Pagerfanta;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\AssortmentBundle\Model\ProductManager as BaseProductManager;
use Sylius\Bundle\AssortmentBundle\Sorting\SorterInterface;
use Sylius\Bundle\AssortmentBundle\Validator\Constraint\ProductUnique as ProductUniqueConstraint;

/**
 * Doctrine MongoDB ODM driver for assortment bundle.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductManager extends BaseProductManager
{
    /**
     * Document manager.
     *
     * @var DocumentManager
     */
    protected $documentManager;

    /**
     * Product document repository.
     *
     * @var DocumentRepository
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param DocumentManager $documentManager
     * @param string          $class
     */
    public function __construct(DocumentManager $documentManager, $class)
    {
        parent::__construct($class);

        $this->documentManager = $documentManager;
        $this->repository = $documentManager->getRepository($this->getClass());
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
        $queryBuilder = $this->repository->createQueryBuilder();

        if (null !== $sorter) {
            $sorter->sort($queryBuilder);
        }

        return new Pagerfanta(new DoctrineODMMongoDBAdapter($queryBuilder));
    }

    /**
     * {@inheritdoc}
     */
    public function validateUnique(ProductInterface $product, ProductUniqueConstraint $constraint)
    {
        $property = $constraint->property;
        $classMetadata = $this->documentManager->getClassMetadata($this->class);

        if (!$classMetadata->hasField($property)) {
            throw new \InvalidArgumentException(sprintf('The "%s" class metadata does not have any "%s" field or association mapping', $this->class, $property));
        }

        $value = $classMetadata->getFieldValue($product, $property);
        $criteria = array($property => $value);

        if ($conflictualProduct = $this->findProductBy($criteria)) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function persistProduct(ProductInterface $product)
    {
        $this->documentManager->persist($product);
        $this->documentManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeProduct(ProductInterface $product)
    {
        $this->documentManager->remove($product);
        $this->documentManager->flush();
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
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findProductBy(array $criteria, $filterDeleted = true)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findProducts($filterDeleted = true)
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findProductsBy(array $criteria, $filterDeleted = true)
    {
        return $this->repository->findBy($criteria);
    }
}
