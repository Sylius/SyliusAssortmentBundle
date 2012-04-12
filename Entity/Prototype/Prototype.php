<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Entity\Prototype;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Bundle\AssortmentBundle\Model\Prototype\Prototype as BasePrototype;

/**
 * Prototype entity.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Prototype extends BasePrototype
{
    /**
     * Overriding constructor to initialize collections.
     */
    public function __construct()
    {
        parent::__construct();

        $this->properties = new ArrayCollection();
        $this->options = new ArrayCollection();
    }
}
