<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\EventDispatcher\Event;

use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Filter option event.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FilterOptionEvent extends Event
{
    /**
     * Option object.
     *
     * @var OptionInterface
     */
    private $option;

    /**
     * Constructor.
     *
     * @param OptionInterface $option
     */
    public function __construct(OptionInterface $option)
    {
        $this->option = $option;
    }

    /**
     * Get option.
     *
     * @return OptionInterface
     */
    public function getOption()
    {
        return $this->option;
    }
}
