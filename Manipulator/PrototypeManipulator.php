<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Manipulator;

use Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface;
use Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeManagerInterface;

/**
 * Prototype manipulator.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PrototypeManipulator implements PrototypeManipulatorInterface
{
    /**
     * Prototype manager.
     *
     * @var PrototypeManagerInterface
     */
    protected $prototypeManager;

    /**
     * Constructor.
     *
     * @param PrototypeManagerInterface $prototypeManager
     */
    public function __construct(PrototypeManagerInterface $prototypeManager)
    {
        $this->prototypeManager = $prototypeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function create(PrototypeInterface $prototype)
    {
        $prototype->incrementCreatedAt();

        $this->prototypeManager->persistPrototype($prototype);
    }

    /**
     * {@inheritdoc}
     */
    public function update(PrototypeInterface $prototype)
    {
        $prototype->incrementUpdatedAt();

        $this->prototypeManager->persistPrototype($prototype);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(PrototypeInterface $prototype)
    {
        $this->prototypeManager->removePrototype($prototype);
    }
}
