<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Model\Option;

use PHPSpec2\ObjectBehavior;

/**
 * Option model spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Option extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Model\Option\Option');
    }

    function it_should_be_a_Sylius_product_option()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface');
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

    function it_should_not_have_presentation_by_default()
    {
        $this->getPresentation()->shouldReturn(null);
    }

    function its_presentation_should_be_mutable()
    {
        $this->setPresentation('Size');
        $this->getPresentation()->shouldReturn('Size');
    }

    function it_should_initialize_values_collection_by_default()
    {
        $this->getValues()->shouldHaveType('Doctrine\Common\Collections\Collection');
    }

    /**
     * @param Doctrine\Common\Collections\Collection $values
     */
    function its_values_collection_should_be_mutable($values)
    {
        $this->setValues($values);
        $this->getValues()->shouldReturn($values);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface $value
     */
    function it_should_add_value_properly($value)
    {
        $value->setOption($this)->shouldBeCalled();

        $this->addValue($value);
        $this->hasValue($value)->shouldReturn(true);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface $value
     */
    function it_should_remove_value_properly($value)
    {
        $value->setOption($this)->shouldBeCalled();

        $this->addValue($value);
        $this->hasValue($value)->shouldReturn(true);

        $value->setOption(null)->shouldBeCalled();

        $this->removeValue($value);
        $this->hasValue($value)->shouldReturn(false);
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
