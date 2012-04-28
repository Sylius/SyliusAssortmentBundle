<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Entity\Variant;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface;
use Sylius\Bundle\AssortmentBundle\Model\Variant\Variant as BaseVariant;

/**
 * Variant entity.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Variant extends BaseVariant
{
    /**
     * Override constructor to initialize collections.
     */
    public function __construct()
    {
        parent::__construct();

        $this->options = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function hasOption(OptionValueInterface $option)
    {
        return $this->options->contains($option);
    }
}
