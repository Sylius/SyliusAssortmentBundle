<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Tests\EventDispatcher\Event;

use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterProductEvent;

class FilterProductEventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $product = $this->getMockProduct();
        $event = new FilterProductEvent($product);
        $this->assertEquals($product, $event->getProduct());
    }

    private function getMockProduct()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\ProductInterface');
    }
}