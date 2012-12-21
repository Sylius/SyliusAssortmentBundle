<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Validator\Constraint;

use PHPSpec2\ObjectBehavior;
use Symfony\Component\Validator\Constraint;

/**
 * Variant combination validation contraint spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantCombination extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Validator\Constraint\VariantCombination');
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
