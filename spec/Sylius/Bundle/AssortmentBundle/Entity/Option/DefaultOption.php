<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Entity\Option;

use PHPSpec2\ObjectBehavior;

/**
 * Product option default entity spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class DefaultOption extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Entity\Option\DefaultOption');
    }

    function it_should_be_a_Sylius_product_option()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface');
    }

    function it_should_extend_the_Sylius_product_option_mapped_superclass()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Entity\Option\Option');
    }
}
