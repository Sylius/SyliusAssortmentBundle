<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Inflector;

/**
 * Slugizer.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Slugizer implements SlugizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function slugize($string)
    {
        return preg_replace('/[^a-z0-9_\s-]/', '', preg_replace("/[\s_]/", "-", preg_replace('!\s+!', ' ', strtolower(trim($string)))));
    }
}
