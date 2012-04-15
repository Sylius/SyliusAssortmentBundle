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

use Sylius\Bundle\AssortmentBundle\Manipulator\PropertyManipulator;

/**
 * Property manipulator test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PropertyManipulatorTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateIncrementsPropertyCreatedAt()
    {
        $property = $this->getMockProperty();
        $property->expects($this->once())
            ->method('incrementCreatedAt')
        ;

        $manipulator = new PropertyManipulator($this->getMockPropertyManager());
        $manipulator->create($property);
    }

    public function testCreatePersistsProperty()
    {
        $property = $this->getMockProperty();

        $propertyManager = $this->getMockPropertyManager();
        $propertyManager->expects($this->once())
            ->method('persistProperty')
            ->with($this->equalTo($property))
        ;

        $manipulator = new PropertyManipulator($propertyManager);
        $manipulator->create($property);
    }

    public function testUpdateIncrementsPropertyUpdatedAt()
    {
        $property = $this->getMockProperty();
        $property->expects($this->once())
            ->method('incrementUpdatedAt')
        ;

        $manipulator = new PropertyManipulator($this->getMockPropertyManager());
        $manipulator->update($property);
    }

    public function testUpdatePersistsProperty()
    {
        $property = $this->getMockProperty();

        $propertyManager = $this->getMockPropertyManager();
        $propertyManager->expects($this->once())
            ->method('persistProperty')
            ->with($this->equalTo($property))
        ;

        $manipulator = new PropertyManipulator($propertyManager);
        $manipulator->update($property);
    }

    public function testDeleteRemovesProperty()
    {
        $property = $this->getMockProperty();

        $propertyManager = $this->getMockPropertyManager();
        $propertyManager->expects($this->once())
            ->method('removeProperty')
            ->with($this->equalTo($property))
        ;

        $manipulator = new PropertyManipulator($propertyManager);
        $manipulator->delete($property);
    }

    private function getMockProperty()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface');
    }

    private function getMockPropertyManager()
    {
        $propertyManager = $this->getMockBuilder('Sylius\Bundle\AssortmentBundle\Model\Property\PropertyManagerInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        return $propertyManager;
    }
}
