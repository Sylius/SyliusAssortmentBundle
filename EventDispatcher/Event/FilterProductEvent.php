<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\EventDispatcher\Event;

use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Filter product event.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FilterProductEvent extends Event
{
    /**
     * Product object.
     *
     * @var ProductInterface
     */
    private $product;

    /**
     * Constructor.
     *
     * @param ProductInterface $product
     */
    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * Get product.
     *
     * @return ProductInterface
     */
    public function getProduct()
    {
        return $this->product;
    }
}
