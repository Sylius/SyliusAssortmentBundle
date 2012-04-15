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

use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterVariantEvent;

/**
 * Filter variant event test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FilterVariantEventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $variant = $this->getMockVariant();
        $event = new FilterVariantEvent($variant);
        $this->assertEquals($variant, $event->getVariant());
    }

    private function getMockVariant()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface');
    }
}
