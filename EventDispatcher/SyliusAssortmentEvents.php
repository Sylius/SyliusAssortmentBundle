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

    const OPTION_CREATE = 'sylius_assortment.event.option.create';
    const OPTION_UPDATE = 'sylius_assortment.event.option.update';
    const OPTION_DELETE = 'sylius_assortment.event.option.delete';

    const PROPERTY_CREATE = 'sylius_assortment.event.property.create';
    const PROPERTY_UPDATE = 'sylius_assortment.event.property.update';
    const PROPERTY_DELETE = 'sylius_assortment.event.property.delete';

    const PROTOTYPE_CREATE = 'sylius_assortment.event.prototype.create';
    const PROTOTYPE_UPDATE = 'sylius_assortment.event.prototype.update';
    const PROTOTYPE_DELETE = 'sylius_assortment.event.prototype.delete';

    const VARIANT_CREATE = 'sylius_assortment.event.variant.create';
    const VARIANT_UPDATE = 'sylius_assortment.event.variant.update';
    const VARIANT_DELETE = 'sylius_assortment.event.variant.delete';
}
