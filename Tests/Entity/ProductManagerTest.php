<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Tests\Entity;

use Sylius\Bundle\AssortmentBundle\Entity\ProductManager;

/**
 * Product manager test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testPersistProduct()
    {
        $product = $this->getMockProduct();

        $entityManager = $this->getMockEntityManager();
        $entityManager->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($product))
        ;
        $entityManager->expects($this->once())
            ->method('flush')
        ;

        $productManager = new ProductManager($entityManager, 'Foo\\Bar');
        $productManager->persistProduct($product);
    }

    public function testRemoveProduct()
    {
        $product = $this->getMockProduct();

        $entityManager = $this->getMockEntityManager();
        $entityManager->expects($this->once())
            ->method('remove')
            ->with($this->equalTo($product))
        ;
        $entityManager->expects($this->once())
            ->method('flush')
        ;

        $productManager = new ProductManager($entityManager, 'Foo\\Bar');
        $productManager->removeProduct($product);
    }

    private function getMockProduct()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\ProductInterface');
    }

    private function getMockEntityManager()
    {
        $entityManager = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        return $entityManager;
    }
}
