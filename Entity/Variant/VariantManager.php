<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Entity\Variant;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantManager as BaseVariantManager;
use Sylius\Bundle\AssortmentBundle\Validator\Constraint\VariantUnique as VariantUniqueConstraint;

/**
 * ORM driver variant manager.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantManager extends BaseVariantManager
{
    /**
     * Entity manager.
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Variant entity repository.
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
    public function createVariant(ProductInterface $product)
    {
        $class = $this->getClass();

        $variant = new $class;
        $variant->setProduct($product);

        return $variant;
    }

    /**
     * {@inheritdoc}
     */
    public function validateUnique(VariantInterface $variant, VariantUniqueConstraint $constraint)
    {
        $property = $constraint->property;
        $classMetadata = $this->entityManager->getClassMetadata($this->class);

        if (!$classMetadata->hasField($property)) {
            throw new \InvalidArgumentException(sprintf('The "%s" class metadata does not have any "%s" field or association mapping', $this->class, $property));
        }

        $value = $classMetadata->getFieldValue($variant, $property);
        $criteria = array($property => $value);

        $conflictualVariant = $this->findVariantBy($criteria);
        if ($conflictualVariant && $variant !== $conflictualVariant) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function persistVariant(VariantInterface $variant)
    {
        $this->entityManager->persist($variant);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeVariant(VariantInterface $variant)
    {
        $this->entityManager->remove($variant);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function findVariant($id)
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findVariantBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findVariants()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findVariantsBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }
}
