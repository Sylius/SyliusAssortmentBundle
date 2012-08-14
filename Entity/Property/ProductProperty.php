<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Entity\Property;

use Sylius\Bundle\AssortmentBundle\Model\Property\ProductProperty as BaseProductProperty;

/**
 * Product property property entity.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductProperty extends BaseProductProperty
{
    /**
     * Method used to detach property from product
     */
    public function detachFromProduct()
    {
        $this->product = null;
    }
}
