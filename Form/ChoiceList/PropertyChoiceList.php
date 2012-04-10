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

use Sylius\Bundle\AssortmentBundle\Model\Property\PropertyManagerInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;

/**
 * Property choice list.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PropertyChoiceList extends ObjectChoiceList
{
    /**
     * Property manager.
     *
     * @var PropertyManagerInterface
     */
    protected $propertyManager;

    /**
     * Constructor.
     *
     * @param $propertyManager
     */
    public function __construct(PropertyManagerInterface $propertyManager)
    {
        $this->propertyManager = $propertyManager;

        parent::__construct($propertyManager->findProperties(), 'presentation', array(), null, null, 'id');
    }
}


