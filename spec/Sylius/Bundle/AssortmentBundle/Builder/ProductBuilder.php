<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Builder;

use PHPSpec2\ObjectBehavior;

/**
 * Product builder spec.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class ProductBuilder extends ObjectBehavior
{
    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\ProductInterface $product
     * @param Doctrine\Common\Persistence\ObjectRepository          $productRepository
     * @param Doctrine\Common\Persistence\ObjectManager             $productManager
     * @param Doctrine\Common\Persistence\ObjectRepository          $propertyRepository
     * @param Doctrine\Common\Persistence\ObjectManager             $propertyManager
     * @param Doctrine\Common\Persistence\ObjectRepository          $productPropertyRepository
     * @param Doctrine\Common\Persistence\ObjectRepository          $optionRepository
     * @param Doctrine\Common\Persistence\ObjectManager             $optionManager
     * @param Doctrine\Common\Persistence\ObjectRepository          $optionValueRepository
     */
    function let(
        $product,
        $productRepository,
        $productManager,
        $propertyRepository,
        $propertyManager,
        $productPropertyRepository,
        $optionRepository,
        $optionManager,
        $optionValueRepository
    )
    {
        $this->beConstructedWith(
            $productRepository,
            $productManager,
            $propertyRepository,
            $propertyManager,
            $productPropertyRepository,
            $optionRepository,
            $optionManager,
            $optionValueRepository
        );

        $productRepository->createNew()->shouldBeCalled()->willReturn($product);

        $this->create('Black GitHub Mug')->shouldReturn($this);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Builder\ProductBuilder');
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface        $property
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface $productProperty
     */
    function it_should_add_property_to_product($propertyRepository, $productPropertyRepository, $product, $property, $productProperty)
    {
        $propertyRepository->findOneBy(array('name' => 'collection'))->shouldBeCalled()->willReturn($property);

        $property->setName('collection');
        $property->setPresentation('collection');

        $productPropertyRepository->createNew()->shouldBeCalled()->willReturn($productProperty);

        $productProperty->setValue(2013);
        $product->addProperty($productProperty);

        $this->addProperty('collection', 2013)->shouldReturn($this);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface        $property
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface $productProperty
     */
    function it_should_set_custom_property_presentation_if_one_passed($propertyRepository, $productPropertyRepository, $product, $property, $productProperty)
    {
        $propertyRepository->findOneBy(array('name' => 'collection'))->shouldBeCalled()->willReturn($property);

        $property->setName('collection');
        $property->setPresentation('collection 2');

        $this->addProperty('collection', 2013, 'collection 2')->shouldReturn($this);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface        $property
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface $productProperty
     */
    function it_should_create_property_if_it_does_not_exist($propertyRepository, $productPropertyRepository, $propertyManager, $product, $property, $productProperty)
    {
        $propertyRepository->findOneBy(array('name' => 'collection'))->shouldBeCalled();
        $propertyRepository->createNew()->shouldBeCalled()->willReturn($property);

        $property->setName('collection');
        $property->setPresentation('collection');
        $propertyManager->persist($property)->shouldBeCalled();

        $productPropertyRepository->createNew()->shouldBeCalled()->willReturn($productProperty);

        $productProperty->setValue(2013);
        $product->addProperty($productProperty);

        $this->addProperty('collection', 2013)->shouldReturn($this);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface      $option
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface $optionValue
     */
    function it_should_add_option_to_product($optionRepository, $optionValueRepository, $product, $option, $optionValue)
    {
        $optionRepository->findOneBy(array('name' => 'size'))->shouldBeCalled()->willReturn($option);

        $optionValueRepository->createNew()->shouldBeCalled()->willReturn($optionValue);

        $this->addOption('size', array('S', 'M', 'L'))->shouldReturn($this);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface      $option
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface $optionValue
     */
    function it_should_create_option_if_it_does_not_exist($optionRepository, $optionValueRepository, $product, $option, $optionValue)
    {
        $optionRepository->findOneBy(array('name' => 'size'))->shouldBeCalled();
        $optionRepository->createNew()->willReturn($option);

        $optionValueRepository->createNew()->shouldBeCalled()->willReturn($optionValue);

        $this->addOption('size', array('S', 'M', 'L'))->shouldReturn($this);
    }

    function it_should_save_product($productManager, $product)
    {
        $productManager->persist($product)->shouldBeCalled();
        $productManager->flush()->shouldBeCalled();

        $this->save()->shouldReturn($this);
    }

    function its_get_method_should_return_product($product)
    {
        $this->get()->shouldReturn($product);
    }

    function it_should_proxy_undefined_methods_to_product($product)
    {
        $name = 'Black GitHub Mug';
        $description = "Coffee. Tea. Coke. Water. Let's face it — humans need to drink liquids";

        $product->setName($name)->shouldBeCalled();
        $product->setDescription($description)->shouldBeCalled();

        $this->setName($name)->shouldReturn($this);
        $this->setDescription($description)->shouldReturn($this);
    }

    function it_should_throw_exception_when_product_method_is_not_defined($product)
    {
        $this->shouldThrow(new \BadMethodCallException('Product have no getFoo() method.'))->during('getFoo');
    }
}
