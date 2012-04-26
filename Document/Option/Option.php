<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Document\Option;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Bundle\AssortmentBundle\Model\Option\Option as BaseOption;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface;

/**
 * Option document.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Option extends BaseOption
{
    /**
     * Override controller to initialize collections.
     */
    public function __construct()
    {
        parent::__construct();

        $this->values = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function addValue(OptionValueInterface $value)
    {
        if (!$this->hasValue($value)) {
            $value->setOption($this);
            $this->values->add($value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeValue(OptionValueInterface $value)
    {
        if ($this->hasValue($value)) {
            $value->setOption(null);
            $this->values->removeElement($value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasValue(OptionValueInterface $value)
    {
        return $this->values->contains($value);
    }
}
