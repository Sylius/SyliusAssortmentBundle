<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Tests\Form\ChoiceList;

use Sylius\Bundle\AssortmentBundle\Form\ChoiceList\VariantChoiceList;

/**
 * Variant choice list test.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantChoiceListTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorReturnsOnlyAvailableVariantsByDefault()
    {
        $product = $this->getMockCustomizableProduct();
        $product->expects($this->once())
            ->method('getAvailableVariants')
            ->will($this->returnValue(array()))
        ;

        $variantChoiceList = new VariantChoiceList($product);

        $this->assertEquals(array(), $variantChoiceList->getChoices());
    }

    public function testGetChoicesReturnsProductVariants()
    {
        $variants = array(
            $this->getMockVariant(),
            $this->getMockVariant(),
            $this->getMockVariant()
        );

        $product = $this->getMockCustomizableProduct();
        $product->expects($this->once())
            ->method('getAvailableVariants')
            ->will($this->returnValue($variants))
        ;

        $variantChoiceList = new VariantChoiceList($product);

        $this->assertEquals($variants, $variantChoiceList->getChoices());
    }

    public function testGetChoicesReturnsAllProductVariantsWhenOptionPassed()
    {
        $availableVariants = array(
            $this->getMockVariant(),
            $this->getMockVariant(),
            $this->getMockVariant()
        );

        $allVariants = array_merge($availableVariants, array(
            $this->getMockVariant()
        ));

        $product = $this->getMockCustomizableProduct();
        $product->expects($this->once())
            ->method('getAvailableVariants')
            ->will($this->returnValue($availableVariants))
        ;
        $product->expects($this->once())
            ->method('getVariants')
            ->will($this->returnValue($allVariants))
        ;

        $variantChoiceList = new VariantChoiceList($product);
        $this->assertEquals($availableVariants, $variantChoiceList->getChoices());

        $variantChoiceList = new VariantChoiceList($product, false);
        $this->assertEquals($allVariants, $variantChoiceList->getChoices());
    }

    private function getMockCustomizableProduct()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface');
    }

    private function getMockVariant()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface');
    }

}
