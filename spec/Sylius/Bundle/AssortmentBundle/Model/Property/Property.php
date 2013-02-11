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

    function its_options_should_be_mutable()
    {
        $this->setOptions(array('choices' => array('Red', 'Blue')));
        $this->getOptions()->shouldReturn(array('choices' => array('Red', 'Blue')));
    }

    function it_should_have_empty_array_options_by_default()
    {
        $this->getOptions()->shouldReturn(array());
    }

    function it_should_have_text_type_by_default()
    {
        $this->getType()->shouldReturn('text');
    }

    function its_choices_should_be_set_when_it_is_choice_property()
    {
        $this->setType('choice');
        $this->setChoices(array('Choice', 'Choice2'));
        $this->getChoices()->shouldReturn(array('Choice', 'Choice2'));
    }

    function its_choices_should_not_be_set_when_pass_empty_choices()
    {
        $this->setChoices(array());
        $this->getChoices()->shouldReturn(array());
        $this->getOptions()->shouldReturn(array());
    }

    function its_choices_should_be_add_to_options()
    {
        $this->setType('choice');
        $this->setChoices(array('Choice', 'Choice2'));
        $this->getOptions()->shouldReturn(array('choices' => array('Choice' => 'Choice', 'Choice2' => 'Choice2')));
    }

    function its_choices_should_be_add_to_options_without_overwrite_others_options()
    {
        $this->setType('choice');
        $this->setOptions(array('required' => 'true', 'choices' => array('oldChoice' => 'old', 'choice2' => 'oldChoice2')));
        $this->setChoices(array('Choice', 'Choice2'));

        $this->getOptions()->shouldReturn(array('required' => 'true', 'choices' => array('Choice' => 'Choice', 'Choice2' => 'Choice2')));
    }

    function its_choices_should_be_empty_array_by_default()
    {
        $this->getChoices()->shouldReturn(array());
    }
}
