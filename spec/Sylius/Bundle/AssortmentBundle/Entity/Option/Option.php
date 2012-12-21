<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Entity\Option;

use PHPSpec2\ObjectBehavior;

/**
 * Product option entity spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Option extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Entity\Option\Option');
    }

    function it_should_be_a_Sylius_product_option()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface');
    }

    function it_should_extend_the_Sylius_product_option_model()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Model\Option\Option');
    }
}
