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
 * Unique option values combination for variant constraint.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 *
 * @Annotation
 */
class UniqueOptionValuesCombination extends Constraint
{
    public $message = 'Variant with this option set already exists';

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'sylius_assortment.validator.unique_option_values_combination';
    }

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
