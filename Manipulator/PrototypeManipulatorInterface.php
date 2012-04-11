<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Manipulator;

use Sylius\Bundle\AssortmentBundle\Model\PrototypeInterface;

/**
 * Prototype manipulator interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface PrototypeManipulatorInterface
{
    /**
     * Creates a prototype.
     *
     * @param PrototypeInterface $prototype
     */
    function create(PrototypeInterface $prototype);

    /**
     * Updates a prototype.
     *
     * @param PrototypeInterface $prototype
     */
    function update(PrototypeInterface $prototype);

    /**
     * Deletes a prototype.
     *
     * @param PrototypeInterface $prototype
     */
    function delete(PrototypeInterface $prototype);
}
