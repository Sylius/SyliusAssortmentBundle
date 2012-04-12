<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Entity\Property;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface;
use Sylius\Bundle\AssortmentBundle\Model\Property\PropertyManager as BasePropertyManager;

/**
 * ORM driver property manager.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PropertyManager extends BasePropertyManager
{
    /**
     * Entity manager.
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Property entity repository.
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
    public function createProperty()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * {@inheritdoc}
     */
    public function persistProperty(PropertyInterface $property)
    {
        $this->entityManager->persist($property);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeProperty(PropertyInterface $property)
    {
        $this->entityManager->remove($property);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function findProperty($id)
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findPropertyBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findProperties()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findPropertiesBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }
}
