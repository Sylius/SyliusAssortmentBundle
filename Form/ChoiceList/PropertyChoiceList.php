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

use Sylius\Bundle\ResourceBundle\Manager\ResourceManagerInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;

/**
 * Property choice list.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PropertyChoiceList extends ObjectChoiceList
{
    /**
     * Constructor.
     *
     * @param ResourceManagerInterface $propertyManager
     */
    public function __construct(ResourceManagerInterface $propertyManager)
    {
        parent::__construct($propertyManager->findAll(), 'name', array(), null, null, 'id');
    }
}
