<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Validator;

use PHPSpec2\ObjectBehavior;
use Sylius\Bundle\AssortmentBundle\Validator\Constraint\VariantUnique;

/**
 * Variant unique constraint validator spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantUniqueValidator extends ObjectBehavior
{
    /**
     * @param Doctrine\Common\Persistence\ObjectRepository                  $variantRepository
     * @param Symfony\Component\Validator\ExecutionContextInterface         $context
     * @param Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface $variant
     */
    function let($variantRepository, $context)
    {
        $this->beConstructedWith($variantRepository);
        $this->initialize($context);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Validator\VariantUniqueValidator');
    }

    function it_should_be_a_constraint_validator()
    {
        $this->shouldImplement('Symfony\Component\Validator\ConstraintValidator');
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface $conflictualVariant
     */
    function it_should_add_violation_if_variant_with_given_property_value_already_exists($variantRepository, $variant, $conflictualVariant, $context)
    {
        $constraint = new VariantUnique(array(
            'property' => 'sku',
            'message'  => 'Variant with given sku already exists'
        ));

        $variant->getSku()->willReturn('IPHONE5WHITE');
        $variantRepository->findOneBy(array('sku' => 'IPHONE5WHITE'))->shouldBeCalled()->willReturn($conflictualVariant);
        $variant->getId()->willReturn(1);
        $conflictualVariant->getId()->willReturn(3);

        $context->addViolationAtSubPath('sku', 'Variant with given sku already exists', ANY_ARGUMENT)->shouldBeCalled();

        $this->validate($variant, $constraint);
    }

    function it_should_not_add_violation_if_variant_with_given_property_value_does_not_exist($variantRepository, $variant, $context)
    {
        $constraint = new VariantUnique(array(
            'property' => 'sku',
            'message'  => 'Variant with given sku already exists'
        ));

        $variant->getSku()->willReturn('111AAA');
        $variantRepository->findOneBy(array('sku' => '111AAA'))->shouldBeCalled()->willReturn(null);

        $context->addViolationAtSubPath(ANY_ARGUMENTS)->shouldNotBeCalled();

        $this->validate($variant, $constraint);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface $conflictualVariant
     */
    function it_should_not_add_violation_if_conflictual_variant_and_validated_one_are_the_same($variantRepository, $variant, $conflictualVariant, $context)
    {
        $constraint = new VariantUnique(array(
            'property' => 'sku',
            'message'  => 'Variant with given sku already exists'
        ));

        $variant->getSku()->willReturn('111AAA');
        $variantRepository->findOneBy(array('sku' => '111AAA'))->shouldBeCalled()->willReturn($conflictualVariant);
        $variant->getId()->willReturn(3);
        $conflictualVariant->getId()->willReturn(3);

        $context->addViolationAtSubPath(ANY_ARGUMENTS)->shouldNotBeCalled();

        $this->validate($variant, $constraint);
    }
}
