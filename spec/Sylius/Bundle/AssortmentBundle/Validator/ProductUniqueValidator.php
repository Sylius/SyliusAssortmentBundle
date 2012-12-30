<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Validator;

use PHPSpec2\ObjectBehavior;
use Sylius\Bundle\AssortmentBundle\Validator\Constraint\ProductUnique;

/**
 * Product unique constraint validator spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductUniqueValidator extends ObjectBehavior
{
    /**
     * @param Doctrine\Common\Persistence\ObjectRepository          $productRepository
     * @param Symfony\Component\Validator\ExecutionContextInterface $context
     * @param Sylius\Bundle\AssortmentBundle\Model\ProductInterface $product
     */
    function let($productRepository, $context)
    {
        $this->beConstructedWith($productRepository);
        $this->initialize($context);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Validator\ProductUniqueValidator');
    }

    function it_should_be_a_constraint_validator()
    {
        $this->shouldImplement('Symfony\Component\Validator\ConstraintValidator');
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\ProductInterface $conflictualProduct
     */
    function it_should_add_violation_if_product_with_given_property_value_already_exists($productRepository, $product, $conflictualProduct, $context)
    {
        $constraint = new ProductUnique(array(
            'property' => 'name',
            'message'  => 'Product with given name already exists'
        ));

        $product->getName()->willReturn('iPhone');
        $productRepository->findOneBy(array('name' => 'iPhone'))->shouldBeCalled()->willReturn($conflictualProduct);
        $product->getId()->willReturn(1);
        $conflictualProduct->getId()->willReturn(3);

        $context->addViolationAtSubPath('name', 'Product with given name already exists', ANY_ARGUMENT)->shouldBeCalled();

        $this->validate($product, $constraint);
    }

    function it_should_not_add_violation_if_product_with_given_property_value_does_not_exist($productRepository, $product, $context)
    {
        $constraint = new ProductUnique(array(
            'property' => 'name',
            'message'  => 'Product with given name already exists'
        ));

        $product->getName()->willReturn('iPhone');
        $productRepository->findOneBy(array('name' => 'iPhone'))->shouldBeCalled()->willReturn(null);

        $context->addViolationAtSubPath(ANY_ARGUMENTS)->shouldNotBeCalled();

        $this->validate($product, $constraint);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\ProductInterface $conflictualProduct
     */
    function it_should_not_add_violation_if_conflictual_product_and_validated_one_are_the_same($productRepository, $product, $conflictualProduct, $context)
    {
        $constraint = new ProductUnique(array(
            'property' => 'name',
            'message'  => 'Product with given name already exists'
        ));

        $product->getName()->willReturn('iPhone');
        $productRepository->findOneBy(array('name' => 'iPhone'))->shouldBeCalled()->willReturn($conflictualProduct);
        $product->getId()->willReturn(3);
        $conflictualProduct->getId()->willReturn(3);

        $context->addViolationAtSubPath(ANY_ARGUMENTS)->shouldNotBeCalled();

        $this->validate($product, $constraint);
    }
}
