<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Entity\Variant;

use PHPSpec2\ObjectBehavior;

/**
 * Variant entity spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Variant extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Entity\Variant\Variant');
    }

    function it_should_be_a_Sylius_product_variant()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface');
    }

    function it_should_extend_the_Sylius_product_variant_model()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Model\Variant\Variant');
    }
}
