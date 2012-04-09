<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Tests\Manipulator;

use Sylius\Bundle\AssortmentBundle\Manipulator\ProductManipulator;

/**
 * Product manipulator test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductManipulatorTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateSetsProductSlug()
    {
        $slugizer = $this->getMockSlugizer();
        $slugizer->expects($this->once())
            ->method('slugize')
            ->with($this->equalTo('foo bar'))
            ->will($this->returnValue('foo-bar'))
        ;

        $product = $this->getMockProduct();
        $product->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('foo bar'))
        ;
        $product->expects($this->once())
            ->method('setSlug')
            ->with($this->equalTo('foo-bar'))
        ;

        $manipulator = new ProductManipulator($this->getMockProductManager(), $slugizer);
        $manipulator->create($product);
    }

    public function testCreateIncrementsProductCreatedAt()
    {
        $slugizer = $this->getMockSlugizer();

        $product = $this->getMockProduct();
        $product->expects($this->once())
            ->method('incrementCreatedAt')
        ;

        $manipulator = new ProductManipulator($this->getMockProductManager(), $slugizer);
        $manipulator->create($product);
    }

    public function testCreatePersistsProduct()
    {
        $slugizer = $this->getMockSlugizer();
        $product = $this->getMockProduct();

        $productManager = $this->getMockProductManager();
        $productManager->expects($this->once())
            ->method('persistProduct')
            ->with($this->equalTo($product))
        ;

        $manipulator = new ProductManipulator($productManager, $slugizer);
        $manipulator->create($product);
    }

    public function testUpdateSetsProductSlug()
    {
        $slugizer = $this->getMockSlugizer();
        $slugizer->expects($this->once())
            ->method('slugize')
            ->with($this->equalTo('foo bar'))
            ->will($this->returnValue('foo-bar'))
        ;

        $product = $this->getMockProduct();
        $product->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('foo bar'))
        ;
        $product->expects($this->once())
            ->method('setSlug')
            ->with($this->equalTo('foo-bar'))
        ;

        $manipulator = new ProductManipulator($this->getMockProductManager(), $slugizer);
        $manipulator->update($product);
    }

    public function testUpdateIncrementsProductUpdatedAt()
    {
        $slugizer = $this->getMockSlugizer();

        $product = $this->getMockProduct();
        $product->expects($this->once())
            ->method('incrementUpdatedAt')
        ;

        $manipulator = new ProductManipulator($this->getMockProductManager(), $slugizer);
        $manipulator->update($product);
    }

    public function testUpdatePersistsProduct()
    {
        $slugizer = $this->getMockSlugizer();
        $product = $this->getMockProduct();

        $productManager = $this->getMockProductManager();
        $productManager->expects($this->once())
            ->method('persistProduct')
            ->with($this->equalTo($product))
        ;

        $manipulator = new ProductManipulator($productManager, $slugizer);
        $manipulator->update($product);
    }

    public function testDeleteRemovesProduct()
    {
        $slugizer = $this->getMockSlugizer();
        $product = $this->getMockProduct();

        $productManager = $this->getMockProductManager();
        $productManager->expects($this->once())
            ->method('removeProduct')
            ->with($this->equalTo($product))
        ;

        $manipulator = new ProductManipulator($productManager, $slugizer);
        $manipulator->delete($product);
    }

    private function getMockProduct()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\ProductInterface');
    }

    private function getMockProductManager()
    {
        $productManager = $this->getMockBuilder('Sylius\Bundle\AssortmentBundle\Model\ProductManagerInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        return $productManager;
    }

    private function getMockSlugizer()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Inflector\SlugizerInterface');
    }
}
