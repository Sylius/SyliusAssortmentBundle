<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\EventDispatcher;

/**
 * Events.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
final class SyliusAssortmentEvents
{
    const PRODUCT_CREATE = 'sylius_assortment.event.product.create';
    const PRODUCT_UPDATE = 'sylius_assortment.event.product.update';
    const PRODUCT_DELETE = 'sylius_assortment.event.product.delete';
}
