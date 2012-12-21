<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Form\DataTransformer;

use PHPSpec2\ObjectBehavior;

/**
 * Product to identifier transformer spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductToIdentifierTransformer extends ObjectBehavior
{
    /**
     * @param Doctrine\Common\Persistence\ObjectRepository $productRepository
     */
    function let($productRepository)
    {
        $this->beConstructedWith($productRepository, 'sku');
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Form\DataTransformer\ProductToIdentifierTransformer');
    }

    function it_should_return_empty_string_if_null_transormed()
    {
        $this->transform(null)->shouldReturn('');
    }

    function it_should_complain_if_not_Sylius_product_transformed()
    {
        $product = new \stdClass();

        $this
            ->shouldThrow('Symfony\Component\Form\Exception\UnexpectedTypeException')
            ->duringTransform($product)
        ;
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\ProductInterface $product
     */
    function it_should_transform_product_into_its_identifier_value($product)
    {
        $product->getSku()->willReturn('IPHONE5BLACK');

        $this->transform($product)->shouldReturn('IPHONE5BLACK');
    }

    function it_should_return_null_if_empty_string_reverse_transformed()
    {
        $this->reverseTransform('')->shouldReturn(null);
    }

    function it_should_return_null_if_product_not_found_on_reverse_transform($productRepository)
    {
        $productRepository
            ->findOneBy(array('sku' => 'IPHONE5WHITE'))
            ->shouldBeCalled()
            ->willReturn(null)
        ;

        $this->reverseTransform('IPHONE5WHITE')->shouldReturn(null);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\ProductInterface $product
     */
    function it_should_product_if_found_on_reverse_transform($productRepository, $product)
    {
        $productRepository
            ->findOneBy(array('sku' => 'IPHONE5BLACK'))
            ->shouldBeCalled()
            ->willReturn($product)
        ;

        $this->reverseTransform('IPHONE5BLACK')->shouldReturn($product);
    }
}
