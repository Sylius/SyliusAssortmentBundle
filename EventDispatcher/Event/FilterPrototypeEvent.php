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

use Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Filter prototype event.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FilterPrototypeEvent extends Event
{
    /**
     * Prototype object.
     *
     * @var PrototypeInterface
     */
    private $prototype;

    /**
     * Constructor.
     *
     * @param PrototypeInterface $prototype
     */
    public function __construct(PrototypeInterface $prototype)
    {
        $this->prototype = $prototype;
    }

    /**
     * Get prototype.
     *
     * @return PrototypeInterface
     */
    public function getPrototype()
    {
        return $this->prototype;
    }
}
