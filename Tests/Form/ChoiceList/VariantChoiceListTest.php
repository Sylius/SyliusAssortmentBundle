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
    public function testConstructor()
    {
        $product = $this->getMockCustmoizableProduct();
        $product->expects($this->once())
            ->method('getVariants')
            ->will($this->returnValue(array()))
        ;

        $variantChoiceList = new VariantChoiceList($product);
    }

    private function getMockCustmoizableProduct()
    {
        return $this->getMock('Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface');
    }

}
