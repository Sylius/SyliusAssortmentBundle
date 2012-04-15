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

    public function testFindProduct()
    {
        $product = $this->getMockProduct();

        $repository = $this->getMockEntityRepository('find', 3, $product);
        $entityManager = $this->getMockEntityManager($repository);

        $productManager = new ProductManager($entityManager, 'Foo\\Bar');

        $this->assertEquals($product, $productManager->findProduct(3));
    }

    public function testFindProductBy()
    {
        $product = $this->getMockProduct();

        $repository = $this->getMockEntityRepository('findOneBy', array('name' => 'Symfony2 mug'), $product);
        $entityManager = $this->getMockEntityManager($repository);

        $productManager = new ProductManager($entityManager, 'Foo\\Bar');

        $this->assertEquals($product, $productManager->findProductBy(array('name' => 'Symfony2 mug')));
    }

    public function testFindProducts()
    {
        $result = array(
            $this->getMockProduct(),
            $this->getMockProduct(),
            $this->getMockProduct()
        );

        $repository = $this->getMockEntityRepository('findAll', null, $result);
        $entityManager = $this->getMockEntityManager($repository);

        $productManager = new ProductManager($entityManager, 'Foo\\Bar');

        $this->assertEquals($result, $productManager->findProducts());
    }

    public function testFindProductsBy()
    {
        $result = array(
            $this->getMockProduct()
        );

        $repository = $this->getMockEntityRepository('findBy', array('name' => 'Symfony2 mug'), $result);
        $entityManager = $this->getMockEntityManager($repository);

        $productManager = new ProductManager($entityManager, 'Foo\\Bar');

        $this->assertEquals($result, $productManager->findProductsBy(array('name' => 'Symfony2 mug')));
    }

    private function getMockProduct()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\ProductInterface');
    }

    private function getMockEntityManager($repository = null)
    {
        $entityManager = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        if (null !== $repository) {
            $entityManager->expects($this->once())
                ->method('getRepository')
                ->will($this->returnValue($repository))
            ;
        }

        return $entityManager;
    }

    private function getMockEntityRepository($method, $criteria, $result)
    {
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        if (null !== $criteria) {
            $repository->expects($this->once())
                ->method($method)
                ->with($this->equalTo($criteria))
                ->will($this->returnValue($result))
            ;
        } else {
            $repository->expects($this->once())
                ->method($method)
                ->will($this->returnValue($result))
            ;
        }

        return $repository;
    }
}
