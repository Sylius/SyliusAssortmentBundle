<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Form\ChoiceList;

use Sylius\Bundle\AssortmentBundle\Model\Option\OptionManagerInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;

/**
 * Option choice list.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class OptionChoiceList extends ObjectChoiceList
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
     * @param $optionManager
     */
    public function __construct(OptionManagerInterface $optionManager)
    {
        $this->optionManager = $optionManager;

        parent::__construct($optionManager->findOptions(), 'name', array(), null, null, 'id');
    }
}

