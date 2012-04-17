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

use Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;

/**
 * Product variant choice list.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantChoiceList extends ObjectChoiceList
{
    /**
     * Constructor.
     *
     * @param CustmoizableProductInterface $product
     */
    public function __construct(CustomizableProductInterface $product)
    {
        parent::__construct($product->getVariants(), 'presentation', array(), null, null, 'id');
    }
}