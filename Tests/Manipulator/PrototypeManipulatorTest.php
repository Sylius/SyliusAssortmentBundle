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

use Sylius\Bundle\AssortmentBundle\Manipulator\PrototypeManipulator;

/**
 * Prototype manipulator test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PrototypeManipulatorTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatePersistsPrototype()
    {
        $prototype = $this->getMockPrototype();

        $prototypeManager = $this->getMockPrototypeManager();
        $prototypeManager->expects($this->once())
            ->method('persistPrototype')
            ->with($this->equalTo($prototype))
        ;

        $manipulator = new PrototypeManipulator($prototypeManager);
        $manipulator->create($prototype);
    }

    public function testUpdatePersistsPrototype()
    {
        $prototype = $this->getMockPrototype();

        $prototypeManager = $this->getMockPrototypeManager();
        $prototypeManager->expects($this->once())
            ->method('persistPrototype')
            ->with($this->equalTo($prototype))
        ;

        $manipulator = new PrototypeManipulator($prototypeManager);
        $manipulator->update($prototype);
    }

    public function testDeleteRemovesPrototype()
    {
        $prototype = $this->getMockPrototype();

        $prototypeManager = $this->getMockPrototypeManager();
        $prototypeManager->expects($this->once())
            ->method('removePrototype')
            ->with($this->equalTo($prototype))
        ;

        $manipulator = new PrototypeManipulator($prototypeManager);
        $manipulator->delete($prototype);
    }

    private function getMockPrototype()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface');
    }

    private function getMockPrototypeManager()
    {
        $prototypeManager = $this->getMockBuilder('Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeManagerInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        return $prototypeManager;
    }
}
