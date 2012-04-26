<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Document\Option;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionManager as BaseOptionManager;

/**
 * MongoDB ODM driver option manager.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class OptionManager extends BaseOptionManager
{
    /**
     * Document manager.
     *
     * @var DocumentManager
     */
    protected $documentManager;

    /**
     * Option document repository.
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
        $this->documentManager->persist($option);
        $this->documentManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeOption(OptionInterface $option)
    {
        $this->documentManager->remove($option);
        $this->documentManager->flush();
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
