<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Model\Property;

use PHPSpec2\ObjectBehavior;

/**
 * Property model spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Property extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Model\Property\Property');
    }

    function it_should_be_a_Sylius_product_property()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface');
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

    function it_should_return_name_when_converted_to_string()
    {
        $this->setName('T-Shirt material');
        $this->__toString()->shouldReturn('T-Shirt material');
    }

    function it_should_not_have_presentation_by_default()
    {
        $this->getPresentation()->shouldReturn(null);
    }

    function its_presentation_should_be_mutable()
    {
        $this->setPresentation('Size');
        $this->getPresentation()->shouldReturn('Size');
    }

    function it_should_initialize_creation_date_by_default()
    {
        $this->getCreatedAt()->shouldHaveType('DateTime');
    }

    function it_should_not_have_last_update_date_by_default()
    {
        $this->getUpdatedAt()->shouldReturn(null);
    }

    function its_type_should_be_mutable()
    {
        $this->setType('boolean');
        $this->getType()->shouldReturn('boolean');
    }

    function it_should_have_text_type_by_default()
    {
        $this->getType()->shouldReturn('text');
    }
}
