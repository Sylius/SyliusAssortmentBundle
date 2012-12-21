<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Entity;

use PHPSpec2\ObjectBehavior;

/**
 * Product entity spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Product extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Entity\Product');
    }

    function it_should_be_a_Sylius_product()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\ProductInterface');
    }

    function it_should_extend_the_Sylius_product_model()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Model\Product');
    }
}
