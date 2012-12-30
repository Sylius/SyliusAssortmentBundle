<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Prototypes;

use Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface;
use Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface;

/**
 * Prototype builder interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface PrototypeBuilderInterface
{
    /**
     * Build the prototype of product.
     *
     * @param PrototypeInterface           $prototype
     * @param CustomizableProductInterface $product
     */
    public function build(PrototypeInterface $prototype, CustomizableProductInterface $product);
}

