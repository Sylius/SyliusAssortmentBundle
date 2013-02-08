<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Model\Property;

use PHPSpec2\ObjectBehavior;

/**
 * Product property model spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductProperty extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Model\Property\ProductProperty');
    }

    function it_should_be_a_Sylius_product_property_pair()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_should_not_belong_to_an_product_by_default()
    {
        $this->getProduct()->shouldReturn(null);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\ProductInterface $product
     */
    function it_should_allow_assigning_itself_to_an_product($product)
    {
        $this->setProduct($product);
        $this->getProduct()->shouldReturn($product);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\ProductInterface $product
     */
    function it_should_allow_detaching_itself_from_an_product($product)
    {
        $this->setProduct($product);
        $this->getProduct()->shouldReturn($product);

        $this->setProduct(null);
        $this->getProduct()->shouldReturn(null);
    }

    function it_should_not_have_property_defined_by_default()
    {
        $this->getProperty()->shouldReturn(null);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface $property
     */
    function its_property_should_be_definable($property)
    {
        $this->setProperty($property);
        $this->getProperty()->shouldReturn($property);
    }

    function it_should_not_have_value_by_default()
    {
        $this->getValue()->shouldReturn(null);
    }

    function its_value_should_be_mutable()
    {
        $this->setValue('XXL');
        $this->getValue()->shouldReturn('XXL');
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface $property
     */
    function it_should_convert_value_to_bool_when_property_is_checkbox_type($property)
    {
        $property->getType()->willReturn('checkbox');
        $this->setProperty($property);

        $this->setValue('XXL');
        $this->getValue()->shouldReturn(true);

        $this->setValue(0);
        $this->getValue()->shouldReturn(false);
    }

    function it_should_return_its_value_when_converteted_to_string()
    {
        $this->setValue('S');
        $this->__toString()->shouldReturn('S');
    }

    function it_should_complain_when_trying_to_get_name_without_property_being_assigned()
    {
        $this
            ->shouldThrow('BadMethodCallException')
            ->duringGetName()
        ;
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface $property
     */
    function it_should_return_its_property_name($property)
    {
        $property->getName()->willReturn('T-Shirt material');
        $this->setProperty($property);

        $this->getName()->shouldReturn('T-Shirt material');
    }

    function it_should_complain_when_trying_to_get_presentation_without_property_being_assigned()
    {
        $this
            ->shouldThrow('BadMethodCallException')
            ->duringGetPresentation()
        ;
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface $property
     */
    function it_should_return_its_property_presentation($property)
    {
        $property->getPresentation()->willReturn('Material');
        $this->setProperty($property);

        $this->getPresentation()->shouldReturn('Material');
    }

    function it_should_complain_when_trying_to_get_type_without_property_being_assigned()
    {
        $this
            ->shouldThrow('BadMethodCallException')
            ->duringGetType()
        ;
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface $property
     */
    function it_should_return_its_property_type($property)
    {
        $property->getType()->willReturn('choice');
        $this->setProperty($property);

        $this->getType()->shouldReturn('choice');
    }

    function it_should_complain_when_trying_to_get_options_without_property_being_assigned()
    {
        $this
            ->shouldThrow('BadMethodCallException')
            ->duringGetOptions()
        ;
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface $property
     */
    function it_should_return_its_property_options($property)
    {
        $property->getOptions()->willReturn(array('choices' => array('Red')));
        $this->setProperty($property);

        $this->getOptions()->shouldReturn(array('choices' => array('Red')));
    }
}
