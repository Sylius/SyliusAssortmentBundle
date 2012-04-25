<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Unique product property constraint.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class UniqueProductConstraint extends Constraint
{
    public $message = 'This property must be unique';

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'sylius_assortment.validator.product.unique';
    }
}
