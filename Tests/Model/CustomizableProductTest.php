<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Tests\Model;

use Sylius\Bundle\AssortmentBundle\Model\CustomizableProduct;

/**
 * Customizable product model test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class CustomizableProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \BadMethodCallException
     */
    public function testGetSkuThrowsExceptionUnlessMasterVariantInitialized()
    {
        $product = $this->getProduct();

        $this->assertNull($product->getMasterVariant());

        $product->getSku();
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testSetSkuThrowsExceptionUnlessMasterVariantInitialized()
    {
        $product = $this->getProduct();

        $this->assertNull($product->getMasterVariant());

        $product->setSku('ABC123EEE');
    }

    public function testGetSetSkuRetrievedViaMasterVariant()
    {
        $product = $this->getProduct();

        $masterVariant = $this->getMockVariant();
        $masterVariant->expects($this->once())
            ->method('getSku')
            ->will($this->returnValue('ABC123EEE'))
        ;
        $masterVariant->expects($this->once())
            ->method('setSku')
            ->with($this->equalTo('EEE123ABC'))
        ;

        $product->setMasterVariant($masterVariant);

        $this->assertEquals('ABC123EEE', $product->getSku());
        $product->setSku('EEE123ABC');
    }

    private function getProduct()
    {
        return new CustomizableProduct();
    }

    private function getMockVariant()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface');
    }
}
