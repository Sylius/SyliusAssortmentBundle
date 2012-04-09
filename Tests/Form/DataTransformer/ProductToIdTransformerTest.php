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

use Sylius\Bundle\AssortmentBundle\Form\DataTransformer\ProductToIdTransformer;

/**
 * Product to id transformer test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductToIdTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransformReturnsNullWhenNullGiven()
    {
        $transformer = new ProductToIdTransformer($this->getMockProductManager());
        $this->assertEquals(null, $transformer->transform(null));
    }

    /**
     * @expectedException \Symfony\Component\Form\Exception\UnexpectedTypeException
     */
    public function testTransformThrowsExceptionWhenInvalidValueGiven()
    {
        $transformer = new ProductToIdTransformer($this->getMockProductManager());
        $transformer->transform(124);
    }

    public function testTransformReturnsProductId()
    {
        $product = $this->getMockProduct();
        $product->expects($this->once())
            ->method('getId')
            ->will($this->returnValue(5))
        ;

        $transformer = new ProductToIdTransformer($this->getMockProductManager());
        $this->assertEquals(5, $transformer->transform($product));
    }

    public function testReverseTransformReturnsNullWhenNullOrEmptyStringGiven()
    {
        $transformer = new ProductToIdTransformer($this->getMockProductManager());

        $this->assertEquals(null, $transformer->reverseTransform(null));
        $this->assertEquals(null, $transformer->reverseTransform(''));
    }

    /**
     * @expectedException \Symfony\Component\Form\Exception\UnexpectedTypeException
     * @dataProvider getNonNumericValues
     */
    public function testReverseTransformThrowsExceptionWhenNonNumericValueGiven($value)
    {
        $transformer = new ProductToIdTransformer($this->getMockProductManager());
        $transformer->reverseTransform($value);
    }

    /**
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testReverseTransformThrowsExceptionWhenProductNotFound()
    {
        $productManager = $this->getMockProductManager();
        $productManager->expects($this->once())
            ->method('findProduct')
            ->will($this->returnValue(null))
        ;

        $transformer = new ProductToIdTransformer($productManager);
        $transformer->reverseTransform(4);
    }

    public function testReverseTransformReturnsProductWhenFound()
    {
        $product = $this->getMockProduct();

        $productManager = $this->getMockProductManager();
        $productManager->expects($this->once())
            ->method('findProduct')
            ->with($this->equalTo(6))
            ->will($this->returnValue($product))
        ;

        $transformer = new ProductToIdTransformer($productManager);
        $this->assertEquals($product, $transformer->reverseTransform(6));
    }

    public function getNonNumericValues()
    {
        return array(
            array('foo bar'),
            array('i haz cheese on my headz, your argument is invalidz'),
            array(new \stdClass())
        );
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
