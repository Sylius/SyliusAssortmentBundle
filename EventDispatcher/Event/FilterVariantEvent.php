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

use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Filter variant event.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FilterVariantEvent extends Event
{
    /**
     * Variant object.
     *
     * @var VariantInterface
     */
    private $variant;

    /**
     * Constructor.
     *
     * @param VariantInterface $variant
     */
    public function __construct(VariantInterface $variant)
    {
        $this->variant = $variant;
    }

    /**
     * Get variant.
     *
     * @return VariantInterface
     */
    public function getVariant()
    {
        return $this->variant;
    }
}
