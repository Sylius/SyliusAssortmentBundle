<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Prototypes;

use Doctrine\Common\Collections\ArrayCollection;
use PHPSpec2\ObjectBehavior;
use Sylius\Bundle\AssortmentBundle\Model\Property\Property;

/**
 * Prototype builder spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PrototypeBuilder extends ObjectBehavior
{
    /**
     * @param Doctrine\Common\Persistence\ObjectRepository $productPropertyRepository
     */
    function let($productPropertyRepository)
    {
        $this->beConstructedWith($productPropertyRepository);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Prototypes\PrototypeBuilder');
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface $prototype
     * @param Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface $product
     * @param Doctrine\Common\Collections\Collection                            $optionsCollection
     */
    function it_should_assign_prototype_options_to_product($prototype, $product, $optionsCollection)
    {
        $prototype->getOptions()->willReturn($optionsCollection);
        $product->setOptions($optionsCollection)->shouldBeCalled();

        $this->build($prototype, $product);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface      $prototype
     * @param Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface      $product
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface $productProperty
     * @param Doctrine\Common\Collections\Collection                                 $optionsCollection
     */
    function it_should_assign_prototype_properties_to_product(
        $productPropertyRepository, $prototype, $product, $productProperty, $optionsCollection
    )
    {
        $property = new Property();

        $prototype->getOptions()->willReturn($optionsCollection);
        $prototype->getProperties()->willReturn(new ArrayCollection(array($property)));

        $productPropertyRepository->createNew()->shouldBeCalled()->willReturn($productProperty);
        $productProperty->setProperty($property)->shouldBeCalled();

        $product->addProperty(ANY_ARGUMENT)->shouldBeCalled();

        $this->build($prototype, $product);
    }
}
