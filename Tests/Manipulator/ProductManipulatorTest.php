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
    public function testCreatePersistsProduct()
    {
        $product = $this->getMockProduct();

        $productManager = $this->getMockProductManager();
        $productManager->expects($this->once())
            ->method('persistProduct')
            ->with($this->equalTo($product))
        ;

        $manipulator = new ProductManipulator($productManager);
        $manipulator->create($product);
    }

    public function testUpdatePersistsProduct()
    {
        $product = $this->getMockProduct();

        $productManager = $this->getMockProductManager();
        $productManager->expects($this->once())
            ->method('persistProduct')
            ->with($this->equalTo($product))
        ;

        $manipulator = new ProductManipulator($productManager);
        $manipulator->update($product);
    }

    public function testDeleteRemovesProduct()
    {
        $product = $this->getMockProduct();

        $productManager = $this->getMockProductManager();
        $productManager->expects($this->once())
            ->method('removeProduct')
            ->with($this->equalTo($product))
        ;

        $manipulator = new ProductManipulator($productManager);
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
}
