<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Validator\Constraint;

use PHPSpec2\ObjectBehavior;
use Symfony\Component\Validator\Constraint;

/**
 * Product unique constraint spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductUnique extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(array('property' => 'sku'));
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Validator\Constraint\ProductUnique');
    }

    function it_should_be_a_validation_constraint()
    {
        $this->shouldHaveType('Symfony\Component\Validator\Constraint');
    }

    function it_should_be_class_constraint()
    {
        $this->getTargets()->shouldReturn(Constraint::CLASS_CONSTRAINT);
    }
}
