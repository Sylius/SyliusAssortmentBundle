<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Controller;

use PHPSpec2\ObjectBehavior;

/**
 * Prototype controller spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PrototypeController extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('sylius_assortment', 'prototype', 'SyliusAssortmentBundle:Prototype');
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Controller\PrototypeController');
    }

    function it_should_be_a_Sylius_resource_controller()
    {
        $this->shouldHaveType('Sylius\Bundle\ResourceBundle\Controller\ResourceController');
    }
}
