<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Model\Option;

use PHPSpec2\ObjectBehavior;

/**
 * Option value model spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class OptionValue extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Model\Option\OptionValue');
    }

    function it_should_be_a_Sylius_product_option_value()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_should_not_belong_to_an_option_by_default()
    {
        $this->getOption()->shouldReturn(null);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface $option
     */
    function it_should_allow_assigning_itself_to_an_option($option)
    {
        $this->setOption($option);
        $this->getOption()->shouldReturn($option);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface $option
     */
    function it_should_allow_detaching_itself_from_an_option($option)
    {
        $this->setOption($option);
        $this->getOption()->shouldReturn($option);

        $this->setOption(null);
        $this->getOption()->shouldReturn(null);
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

    function it_should_return_its_value_when_converteted_to_string()
    {
        $this->setValue('S');
        $this->__toString()->shouldReturn('S');
    }

    function it_should_complain_when_trying_to_get_name_without_option_being_assigned()
    {
        $this
            ->shouldThrow('BadMethodCallException')
            ->duringGetName()
        ;
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface $option
     */
    function it_should_return_its_option_name($option)
    {
        $option->getName()->willReturn('T-Shirt size');
        $this->setOption($option);

        $this->getName()->shouldReturn('T-Shirt size');
    }

    function it_should_complain_when_trying_to_get_presentation_without_option_being_assigned()
    {
        $this
            ->shouldThrow('BadMethodCallException')
            ->duringGetPresentation()
        ;
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface $option
     */
    function it_should_return_its_option_presentation($option)
    {
        $option->getPresentation()->willReturn('Size');
        $this->setOption($option);

        $this->getPresentation()->shouldReturn('Size');
    }
}
