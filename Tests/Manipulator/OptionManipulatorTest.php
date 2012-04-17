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

use Sylius\Bundle\AssortmentBundle\Manipulator\OptionManipulator;

/**
 * Option manipulator test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class OptionManipulatorTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatePersistsOption()
    {
        $option = $this->getMockOption();

        $optionManager = $this->getMockOptionManager();
        $optionManager->expects($this->once())
            ->method('persistOption')
            ->with($this->equalTo($option))
        ;

        $manipulator = new OptionManipulator($optionManager);
        $manipulator->create($option);
    }

    public function testUpdatePersistsOption()
    {
        $option = $this->getMockOption();

        $optionManager = $this->getMockOptionManager();
        $optionManager->expects($this->once())
            ->method('persistOption')
            ->with($this->equalTo($option))
        ;

        $manipulator = new OptionManipulator($optionManager);
        $manipulator->update($option);
    }

    public function testDeleteRemovesOption()
    {
        $option = $this->getMockOption();

        $optionManager = $this->getMockOptionManager();
        $optionManager->expects($this->once())
            ->method('removeOption')
            ->with($this->equalTo($option))
        ;

        $manipulator = new OptionManipulator($optionManager);
        $manipulator->delete($option);
    }

    private function getMockOption()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface');
    }

    private function getMockOptionManager()
    {
        $optionManager = $this->getMockBuilder('Sylius\Bundle\AssortmentBundle\Model\Option\OptionManagerInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        return $optionManager;
    }
}
