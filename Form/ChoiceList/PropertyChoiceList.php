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

use Doctrine\Common\Persistence\ObjectRepository;
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
     * @param ObjectRepository $propertyRepository
     */
    public function __construct(ObjectRepository $propertyRepository)
    {
        parent::__construct($propertyRepository->findAll(), 'name', array(), null, null, 'id');
    }
}
