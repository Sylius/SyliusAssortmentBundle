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

use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterPrototypeEvent;

/**
 * Filter prototype event test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FilterPrototypeEventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $prototype = $this->getMockPrototype();
        $event = new FilterPrototypeEvent($prototype);
        $this->assertEquals($prototype, $event->getPrototype());
    }

    private function getMockPrototype()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface');
    }
}
