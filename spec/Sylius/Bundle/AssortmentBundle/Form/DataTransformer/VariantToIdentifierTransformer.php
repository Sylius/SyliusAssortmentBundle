<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Form\DataTransformer;

use PHPSpec2\ObjectBehavior;

/**
 * Variant to identifier transformer spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantToIdentifierTransformer extends ObjectBehavior
{
    /**
     * @param Doctrine\Common\Persistence\ObjectRepository $variantRepository
     */
    function let($variantRepository)
    {
        $this->beConstructedWith($variantRepository, 'sku');
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Form\DataTransformer\VariantToIdentifierTransformer');
    }

    function it_should_return_empty_string_if_null_transormed()
    {
        $this->transform(null)->shouldReturn('');
    }

    function it_should_complain_if_not_Sylius_variant_transformed()
    {
        $variant = new \stdClass();

        $this
            ->shouldThrow('Symfony\Component\Form\Exception\UnexpectedTypeException')
            ->duringTransform($variant)
        ;
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface $variant
     */
    function it_should_transform_variant_into_its_identifier_value($variant)
    {
        $variant->getSku()->willReturn('IPHONE5BLACK');

        $this->transform($variant)->shouldReturn('IPHONE5BLACK');
    }

    function it_should_return_null_if_empty_string_reverse_transformed()
    {
        $this->reverseTransform('')->shouldReturn(null);
    }

    function it_should_return_null_if_variant_not_found_on_reverse_transform($variantRepository)
    {
        $variantRepository
            ->findOneBy(array('sku' => 'IPHONE5WHITE'))
            ->shouldBeCalled()
            ->willReturn(null)
        ;

        $this->reverseTransform('IPHONE5WHITE')->shouldReturn(null);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface $variant
     */
    function it_should_variant_if_found_on_reverse_transform($variantRepository, $variant)
    {
        $variantRepository
            ->findOneBy(array('sku' => 'IPHONE5BLACK'))
            ->shouldBeCalled()
            ->willReturn($variant)
        ;

        $this->reverseTransform('IPHONE5BLACK')->shouldReturn($variant);
    }
}
