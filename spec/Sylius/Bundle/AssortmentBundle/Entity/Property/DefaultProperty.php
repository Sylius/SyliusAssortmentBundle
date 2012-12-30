<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Entity\Property;

use PHPSpec2\ObjectBehavior;

/**
 * Property default entity spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class DefaultProperty extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Entity\Property\Property');
    }

    function it_should_be_a_Sylius_product_property()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface');
    }

    function it_should_extend_the_Sylius_product_property_mapped_superclass()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Entity\Property\Property');
    }
}
