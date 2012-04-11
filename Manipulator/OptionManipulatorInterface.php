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

use Sylius\Bundle\AssortmentBundle\Model\OptionInterface;

/**
 * Option manipulator interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface OptionManipulatorInterface
{
    /**
     * Creates a option.
     *
     * @param OptionInterface $option
     */
    function create(OptionInterface $option);

    /**
     * Updates a option.
     *
     * @param OptionInterface $option
     */
    function update(OptionInterface $option);

    /**
     * Deletes a option.
     *
     * @param OptionInterface $option
     */
    function delete(OptionInterface $option);
}
