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
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantManager as BaseVariantManager;

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
    public function createVariant()
    {
        $class = $this->getClass();

        return new $class;
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
