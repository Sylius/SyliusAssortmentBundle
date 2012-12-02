<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Entity;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * Customizable product entity repository.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class CustomizableProductRepository extends EntityRepository
{
    protected function getQueryBuilder()
    {
        return parent::getQueryBuilder()
            ->select('p, mv, v, o, ov, ppr, pr')
            ->join('p.masterVariant', 'mv')
            ->leftJoin('p.variants', 'v')
            ->leftJoin('p.options', 'o')
            ->leftJoin('o.values', 'ov')
            ->leftJoin('p.properties', 'ppr')
            ->leftJoin('ppr.property', 'pr')
        ;
    }

    protected function getCollectionQueryBuilder()
    {
        return parent::getQueryBuilder()
            ->select('p, mv')
            ->leftJoin('p.masterVariant', 'mv')
        ;
    }

    protected function getAlias()
    {
        return 'p';
    }
}
