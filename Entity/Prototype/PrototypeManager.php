<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Entity\Prototype;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface;
use Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeManager as BasePrototypeManager;

/**
 * ORM driver prototype manager.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PrototypeManager extends BasePrototypeManager
{
    /**
     * Entity manager.
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Prototype entity repository.
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
    public function createPrototype()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * {@inheritdoc}
     */
    public function persistPrototype(PrototypeInterface $prototype)
    {
        $this->entityManager->persist($prototype);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removePrototype(PrototypeInterface $prototype)
    {
        $this->entityManager->remove($prototype);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function findPrototype($id)
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findPrototypeBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findPrototypes()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findPrototypesBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }
}
