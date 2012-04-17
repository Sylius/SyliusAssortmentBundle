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

use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionManagerInterface;

/**
 * Option manipulator.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class OptionManipulator implements OptionManipulatorInterface
{
    /**
     * Option manager.
     *
     * @var OptionManagerInterface
     */
    protected $optionManager;

    /**
     * Constructor.
     *
     * @param OptionManagerInterface $optionManager
     */
    public function __construct(OptionManagerInterface $optionManager)
    {
        $this->optionManager = $optionManager;
    }

    /**
     * {@inheritdoc}
     */
    public function create(OptionInterface $option)
    {
        $this->optionManager->persistOption($option);
    }

    /**
     * {@inheritdoc}
     */
    public function update(OptionInterface $option)
    {
        $this->optionManager->persistOption($option);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(OptionInterface $option)
    {
        $this->optionManager->removeOption($option);
    }
}
