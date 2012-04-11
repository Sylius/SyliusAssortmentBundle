<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Entity\Option;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionManager as BaseOptionManager;

/**
 * ORM driver option manager.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class OptionManager extends BaseOptionManager
{
    /**
     * Entity manager.
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Option entity repository.
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
    public function createOption()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * {@inheritdoc}
     */
    public function persistOption(OptionInterface $option)
    {
        $this->entityManager->persist($option);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeOption(OptionInterface $option)
    {
        $this->entityManager->remove($option);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function findOption($id)
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findOptionBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findOptions()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findOptionsBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }
}
