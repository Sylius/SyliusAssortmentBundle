<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Entity\Property;

use PHPSpec2\ObjectBehavior;

/**
 * Product property default entity spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class DefaultProductProperty extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Entity\Property\ProductProperty');
    }

    function it_should_be_a_Sylius_product_property()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface');
    }

    function it_should_extend_the_Sylius_product_property_mapped_superclass()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Model\Property\ProductProperty');
    }
}
