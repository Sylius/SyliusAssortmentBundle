<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Bundle\AssortmentBundle\Model\FluidProduct as BaseFluidProduct;
use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;

/**
 * Base fluid product document.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FluidProduct extends BaseFluidProduct
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
    public function addOption(OptionInterface $option)
    {
        if (!$this->hasOption($option)) {
            $this->options->add($option);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeOption(OptionInterface $option)
    {
        if ($this->hasOption($option)) {
            $this->options->removeElement($option);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasOption(OptionInterface $option)
    {
        return $this->options->contains($option);
    }
}
