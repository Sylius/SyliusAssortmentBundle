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

use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterPropertyEvent;

/**
 * Filter property event test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FilterPropertyEventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $property = $this->getMockProperty();
        $event = new FilterPropertyEvent($property);
        $this->assertEquals($property, $event->getProperty());
    }

    private function getMockProperty()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface');
    }
}
