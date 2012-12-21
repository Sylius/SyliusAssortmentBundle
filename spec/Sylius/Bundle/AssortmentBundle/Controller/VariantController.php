<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Controller;

use PHPSpec2\ObjectBehavior;

/**
 * Variant controller spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantController extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('sylius_assortment', 'variant', 'SyliusAssortmentBundle:Variant');
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Controller\VariantController');
    }

    function it_should_be_a_Sylius_resource_controller()
    {
        $this->shouldHaveType('Sylius\Bundle\ResourceBundle\Controller\ResourceController');
    }
}
