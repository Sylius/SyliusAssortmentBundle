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

use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;

/**
 * Variant manipulator interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface VariantManipulatorInterface
{
    /**
     * Creates a variant.
     *
     * @param VariantInterface $variant
     */
    function create(VariantInterface $variant);

    /**
     * Updates a variant.
     *
     * @param VariantInterface $variant
     */
    function update(VariantInterface $variant);

    /**
     * Deletes a variant.
     *
     * @param VariantInterface $variant
     */
    function delete(VariantInterface $variant);
}
