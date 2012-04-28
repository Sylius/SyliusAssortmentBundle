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

use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Base controller.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Controller extends ContainerAware
{
    /**
     * Set flash shortcut method.
     *
     * @param string $name
     * @param mixed  $value
     */
    protected function setFlash($name, $value)
    {
        $this->container->get('session')->setFlash($name, $value);
    }

    /**
     * Returns templating engine name.
     *
     * @return string
     */
    protected function getEngine()
    {
        return $this->container->getParameter('sylius_assortment.engine');
    }
}
