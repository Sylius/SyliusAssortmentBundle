<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Tests\Form\DataTransformer;

use Sylius\Bundle\AssortmentBundle\Form\DataTransformer\ProductToIdentifierTransformer;

/**
 * Product to id transformer test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductToIdentifierTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransformReturnsEmptyStringWhenNullGiven()
    {
        $transformer = new ProductToIdentifierTransformer($this->getMockProductManager(), 'id');
        $this->assertEquals('', $transformer->transform(null));
    }

    /**
     * @expectedException \Symfony\Component\Form\Exception\UnexpectedTypeException
     */
    public function testTransformThrowsExceptionWhenInvalidValueGiven()
    {
        $transformer = new ProductToIdentifierTransformer($this->getMockProductManager(), 'id');
        $transformer->transform(124);
    }

    public function testTransformReturnsProductIdentifier()
    {
        $product = $this->getMockProduct();
        $product->expects($this->once())
            ->method('getId')
            ->will($this->returnValue(5))
        ;

        $transformer = new ProductToIdentifierTransformer($this->getMockProductManager(), 'id');
        $this->assertEquals(5, $transformer->transform($product));
    }

    public function testReverseTransformReturnsNullWhenNullOrEmptyStringGiven()
    {
        $transformer = new ProductToIdentifierTransformer($this->getMockProductManager(), 'id');

        $this->assertEquals(null, $transformer->reverseTransform(null));
        $this->assertEquals(null, $transformer->reverseTransform(''));
    }

    public function testReverseTransformReturnsNullWhenProductNotFound()
    {
        $productManager = $this->getMockProductManager();
        $productManager->expects($this->once())
            ->method('findProductBy')
            ->will($this->returnValue(null))
        ;

        $transformer = new ProductToIdentifierTransformer($productManager, 'id');
        $this->assertEquals(null, $transformer->reverseTransform(4));
    }

    public function testReverseTransformReturnsProductWhenFound()
    {
        $product = $this->getMockProduct();

        $productManager = $this->getMockProductManager();
        $productManager->expects($this->once())
            ->method('findProductBy')
            ->with($this->equalTo(array('foo' => 6)))
            ->will($this->returnValue($product))
        ;

        $transformer = new ProductToIdentifierTransformer($productManager, 'foo');
        $this->assertEquals($product, $transformer->reverseTransform(6));
    }

    private function getMockProduct()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\ProductInterface');
    }

    private function getMockProductManager()
    {
        return $this->getMockBuilder('Sylius\Bundle\AssortmentBundle\Model\ProductManagerInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;
    }
}
