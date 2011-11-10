<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Sorting\ORM;

use Symfony\Component\DependencyInjection\ContainerAware;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\AssortmentBundle\Sorting\SorterInterface;

/**
 * Default ORM sorter.
 * Sorts product entities.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductSorter extends ContainerAware implements SorterInterface
{
    public function sort($sortable)
    {
        if (!$sortable instanceof QueryBuilder) {
            throw new InvalidArgumentException('Default sorter supports only "Doctrine\\ORM\\QueryBuilder" as sortable argument.');
        }
        
        $request = $this->container->get('request');
        
        if (null === $sortProperty = $request->query->get('sort', null)) {
            
            return;
        }
        
        $sortOrder = $request->query->get('order', 'ASC');
        
        if (!in_array($sortOrder, array('ASC', 'DESC'))) {
            
            return;
        }
        
        $productClass = $this->container->getParameter('sylius_assortment.model.product.class');
        $reflectionClass = new \ReflectionClass($productClass);
        
        if (!in_array($sortProperty, array_keys($reflectionClass->getDefaultProperties()))) {
            
            return;
        }
        
        /** @var QueryBuilder */
        $sortable->orderBy('p.' . $sortProperty, $sortOrder);
    }
    
    public function getOrder()
    {
        $sortOrder = $this->container->get('request')->query->get('order', 'ASC');
    
        if (!in_array($sortOrder, array('ASC', 'DESC'))) {
    
            return;
        }
    
        return ($sortOrder == 'ASC') ? 'DESC' : 'ASC';
    }
}
