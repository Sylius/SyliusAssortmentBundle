<?php

namespace spec\Sylius\Bundle\AssortmentBundle\DependencyInjection;

use PHPSpec2\ObjectBehavior;

/**
 * Sylius assortment extension spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class SyliusAssortmentExtension extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\DependencyInjection\SyliusAssortmentExtension');
    }

    function it_should_be_a_container_extension()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\DependencyInjection\Extension');
    }
}
