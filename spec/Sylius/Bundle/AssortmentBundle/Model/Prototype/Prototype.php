<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Model\Prototype;

use PHPSpec2\ObjectBehavior;

/**
 * Product prototype spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Prototype extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Model\Prototype\Prototype');
    }

    function it_should_be_Sylius_product_prototype()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_should_not_have_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    function its_name_should_be_mutable()
    {
        $this->setName('T-Shirt size');
        $this->getName()->shouldReturn('T-Shirt size');
    }

    function it_should_initialize_option_collection_by_default()
    {
        $this->getOptions()->shouldHaveType('Doctrine\Common\Collections\Collection');
    }

    /**
     * @param Doctrine\Common\Collections\Collection $options
     */
    function its_options_collection_should_be_mutable($options)
    {
        $this->setOptions($options);
        $this->getOptions()->shouldReturn($options);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface $option
     */
    function it_should_add_option_properly($option)
    {
        $this->addOption($option);
        $this->hasOption($option)->shouldReturn(true);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface $option
     */
    function it_should_remove_option_properly($option)
    {
        $this->addOption($option);
        $this->hasOption($option)->shouldReturn(true);

        $this->removeOption($option);
        $this->hasOption($option)->shouldReturn(false);
    }

    function it_should_initialize_property_collection_by_default()
    {
        $this->getProperties()->shouldHaveType('Doctrine\Common\Collections\Collection');
    }

    /**
     * @param Doctrine\Common\Collections\Collection $properties
     */
    function its_properties_collection_should_be_mutable($properties)
    {
        $this->setProperties($properties);
        $this->getProperties()->shouldReturn($properties);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface $property
     */
    function it_should_add_property_properly($property)
    {
        $this->addProperty($property);
        $this->hasProperty($property)->shouldReturn(true);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface $property
     */
    function it_should_remove_property_properly($property)
    {
        $this->addProperty($property);
        $this->hasProperty($property)->shouldReturn(true);

        $this->removeProperty($property);
        $this->hasProperty($property)->shouldReturn(false);
    }

    function it_should_initialize_creation_date_by_default()
    {
        $this->getCreatedAt()->shouldHaveType('DateTime');
    }

    function it_should_not_have_last_update_date_by_default()
    {
        $this->getUpdatedAt()->shouldReturn(null);
    }
}
