<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Variant;

/**
 * Product variant manager base class.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
abstract class VariantManager implements VariantManagerInterface
{
    /**
     * Variant class.
     *
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @var string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * Returns FQCN of variant model.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}
