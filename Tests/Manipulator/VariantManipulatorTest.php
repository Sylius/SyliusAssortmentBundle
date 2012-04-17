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

use Sylius\Bundle\AssortmentBundle\Manipulator\VariantManipulator;

/**
 * Variant manipulator test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantManipulatorTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatePersistsVariant()
    {
        $variant = $this->getMockVariant();

        $variantManager = $this->getMockVariantManager();
        $variantManager->expects($this->once())
            ->method('persistVariant')
            ->with($this->equalTo($variant))
        ;

        $manipulator = new VariantManipulator($variantManager);
        $manipulator->create($variant);
    }

    public function testUpdatePersistsVariant()
    {
        $variant = $this->getMockVariant();

        $variantManager = $this->getMockVariantManager();
        $variantManager->expects($this->once())
            ->method('persistVariant')
            ->with($this->equalTo($variant))
        ;

        $manipulator = new VariantManipulator($variantManager);
        $manipulator->update($variant);
    }

    public function testDeleteRemovesVariant()
    {
        $variant = $this->getMockVariant();

        $variantManager = $this->getMockVariantManager();
        $variantManager->expects($this->once())
            ->method('removeVariant')
            ->with($this->equalTo($variant))
        ;

        $manipulator = new VariantManipulator($variantManager);
        $manipulator->delete($variant);
    }

    private function getMockVariant()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface');
    }

    private function getMockVariantManager()
    {
        $variantManager = $this->getMockBuilder('Sylius\Bundle\AssortmentBundle\Model\Variant\VariantManagerInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        return $variantManager;
    }
}
