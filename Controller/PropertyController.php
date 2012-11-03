<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;

/**
 * Assortment frontend controller.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PropertyController extends ResourceController
{
    /**
     * {@inheritdoc}
     */
    protected function getBundlePrefix()
    {
        return 'sylius_assortment';
    }

    /**
     * {@inheritdoc}
     */
    protected function getResourceName()
    {
        return 'property';
    }

    /**
     * {@inheritdoc}
     */
    protected function getTemplateNamespace()
    {
        return 'SyliusAssortmentBundle:Property';
    }
}
