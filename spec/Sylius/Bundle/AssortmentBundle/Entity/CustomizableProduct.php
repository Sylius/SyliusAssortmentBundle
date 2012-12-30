<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Entity;

use PHPSpec2\ObjectBehavior;

/**
 * Customizable product mapped superlcass spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class CustomizableProduct extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Entity\CustomizableProduct');
    }

    function it_should_be_a_Sylius_customizable_product()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface');
    }

    function it_should_extend_the_Sylius_customizable_product_model()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Model\CustomizableProduct');
    }
}
