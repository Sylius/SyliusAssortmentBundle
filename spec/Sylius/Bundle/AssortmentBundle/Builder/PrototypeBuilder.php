<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Builder;

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
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Builder\PrototypeBuilder');
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface $prototype
     * @param Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface $product
     * @param Sylius\Bundle\AssortmentBundle\Entity\Option\Option $option1
     * @param Sylius\Bundle\AssortmentBundle\Entity\Option\Option $option2
     */
    function it_should_assign_prototype_options_to_product($prototype, $product, $option1, $option2)
    {
        $prototype->getOptions()->willReturn(array($option1, $option2));
        $product->addOption($option1)->shouldBeCalled();
        $product->addOption($option2)->shouldBeCalled();

        $this->build($prototype, $product);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface      $prototype
     * @param Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface      $product
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface $productProperty
     */
    function it_should_assign_prototype_properties_to_product(
        $productPropertyRepository, $prototype, $product, $productProperty
    )
    {
        $property = new Property();

        $prototype->getOptions()->willReturn(new ArrayCollection());
        $prototype->getProperties()->willReturn(new ArrayCollection(array($property)));

        $productPropertyRepository->createNew()->shouldBeCalled()->willReturn($productProperty);
        $productProperty->setProperty($property)->shouldBeCalled();

        $product->addProperty(ANY_ARGUMENT)->shouldBeCalled();

        $this->build($prototype, $product);
    }
}
