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

use Sylius\Bundle\AssortmentBundle\Model\Product;

/**
 * Product model test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSetId()
    {
        $product = $this->getProduct();
        $this->assertNull($product->getId());

        $product->setId(321);
        $this->assertEquals(321, $product->getId());
    }

    public function testGetSetSku()
    {
        $product = $this->getProduct();
        $this->assertNull($product->getSku());

        $product->setSku('ABC123EEE');
        $this->assertEquals('ABC123EEE', $product->getSku());
    }

    public function testGetSetName()
    {
        $product = $this->getProduct();
        $this->assertNull($product->getName());

        $product->setName('testing product');
        $this->assertEquals('testing product', $product->getName());
    }

    public function testGetSetSlug()
    {
        $product = $this->getProduct();
        $this->assertNull($product->getSlug());

        $product->setSlug('testing-product');
        $this->assertEquals('testing-product', $product->getSlug());
    }

    public function testGetSetDescription()
    {
        $product = $this->getProduct();
        $this->assertNull($product->getDescription());

        $product->setDescription('testing product');
        $this->assertEquals('testing product', $product->getDescription());
    }

    public function testGetSetCreatedAt()
    {
        $product = $this->getProduct();
        $this->assertNull($product->getCreatedAt());

        $now = new \DateTime("now");

        $product->setCreatedAt($now);
        $this->assertEquals($now, $product->getCreatedAt());
    }

    public function testIncrementCreatedAt()
    {
        $product = $this->getProduct();

        $sample = new \DateTime("now");

        $product->setCreatedAt($sample);
        $this->assertEquals($sample, $product->getCreatedAt());

        sleep(1);

        $product->incrementCreatedAt();
        $this->assertGreaterThan($sample, $product->getCreatedAt());
    }

    public function testGetSetUpdatedAt()
    {
        $product = $this->getProduct();
        $this->assertNull($product->getUpdatedAt());

        $now = new \DateTime("now");

        $product->setUpdatedAt($now);
        $this->assertEquals($now, $product->getUpdatedAt());
    }

    public function testIncrementUpdatedAt()
    {
        $product = $this->getProduct();

        $sample = new \DateTime("now");

        $product->setUpdatedAt($sample);
        $this->assertEquals($sample, $product->getUpdatedAt());

        sleep(1);

        $product->incrementUpdatedAt();
        $this->assertGreaterThan($sample, $product->getUpdatedAt());
    }

    private function getProduct()
    {
        return new Product();
    }
}
