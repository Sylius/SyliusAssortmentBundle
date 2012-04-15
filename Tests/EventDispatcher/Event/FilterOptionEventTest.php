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

use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterOptionEvent;

/**
 * Filter option event test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FilterOptionEventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $option = $this->getMockOption();
        $event = new FilterOptionEvent($option);
        $this->assertEquals($option, $event->getOption());
    }

    private function getMockOption()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface');
    }
}
