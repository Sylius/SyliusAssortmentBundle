<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Entity\Option;

use PHPSpec2\ObjectBehavior;

/**
 * Product option value default entity spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class DefaultOptionValue extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Entity\Option\OptionValue');
    }

    function it_should_be_a_Sylius_product_option_value()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface');
    }

    function it_should_extend_the_Sylius_product_option_mapped_superclass()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Entity\Option\OptionValue');
    }
}
