<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Sorting;

/**
 * Delegating sorter.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class DelegatingSorter implements SorterInterface
{
    private $sorters;
    
    public function __construct()
    {
        $this->sorters = array();
    }
    
    /**
     * Registers sorter.
     * 
     * @param SorterInterface $sorter
     */
    public function registerSorter(SorterInterface $sorter)
    {
        $this->sorters[] = $sorter;
    }
    
    /**
     * Unregisters sorter.
     * 
     * @param SorterInterface $sorter
     */
    public function unregisterSorter(SorterInterface $sorter)
    {
    }
    
    /**
     * {@inheritdoc}
     */
    public function sort($sortable)
    {
        foreach ($this->sorters as $sorter) {
            $sorter->sort($sortable);
        }
    }
}
