<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Form\EventListener;

use PHPSpec2\ObjectBehavior;

class BuildProductPropertyFormListener extends ObjectBehavior
{
    /**
     * @param Symfony\Component\Form\FormFactoryInterface $formFactory
     */
    function let($formFactory)
    {
        $this->beConstructedWith($formFactory);
    }

    function it_should_subscribe_pre_set_data_event()
    {
        self::getSubscribedEvents()->shouldReturn(array('form.pre_set_data' => 'buildForm'));
    }

    /**
     * @param Symfony\Component\Form\Event\DataEvent $event
     * @param Symfony\Component\Form\Form $form
     * @param Symfony\Component\Form\Form $valueField
     */
    function it_should_build_form_with_property_and_value_when_new_product_property(
        $event, $form, $valueField, $formFactory
    )
    {
        $event->getData()->willReturn(null);
        $event->getForm()->willReturn($form);

        $formFactory->createNamed('value', 'text')->willReturn($valueField)->shouldBeCalled();
        $form->add($valueField)->shouldBeCalled()->willReturn($form);

        $this->buildForm($event);
    }

    /**
     * @param Symfony\Component\Form\Event\DataEvent $event
     * @param Symfony\Component\Form\Form $form
     * @param Sylius\Bundle\AssortmentBundle\Model\ProductPropertyInterface $product
     * @param Symfony\Component\Form\Form $valueField
     */
    function it_should_build_value_field_base_on_product_property(
        $event, $form, $productProperty, $valueField, $formFactory
    )
    {
        $productProperty->getType()->willReturn('checkbox');
        $productProperty->getName()->willReturn('My name');

        $event->getData()->willReturn($productProperty);
        $event->getForm()->willReturn($form);

        $formFactory->createNamed('value', 'checkbox', null, array('label' => 'My name'))->willReturn($valueField)->shouldBeCalled();

        $form->remove('property')->shouldBeCalled()->willReturn($form);
        $form->add($valueField)->shouldBeCalled()->willReturn($form);

        $this->buildForm($event);
    }

    /**
     * @param Symfony\Component\Form\Event\DataEvent $event
     * @param Symfony\Component\Form\Form $form
     * @param Sylius\Bundle\AssortmentBundle\Model\ProductPropertyInterface $product
     * @param Symfony\Component\Form\Form $valueField
     */
    function it_should_build_options_base_on_product_property(
        $event, $form, $productProperty, $valueField, $formFactory
    )
    {
        $productProperty->getType()->willReturn('choice');
        $productProperty->getOptions()->willReturn(array(
            'choices' => array(
                'red' => 'Red',
                'blue' => 'Blue'
            ) 
        ));
        $productProperty->getName()->willReturn('My name');

        $event->getData()->willReturn($productProperty);
        $event->getForm()->willReturn($form);

        $formFactory
            ->createNamed(
                'value',
                'choice',
                null,
                array('label' => 'My name', 'choices' => array('red' => 'Red', 'blue' => 'Blue'))
            )
            ->willReturn($valueField)
            ->shouldBeCalled()
        ;

        $form->remove('property')->shouldBeCalled()->willReturn($form);
        $form->add($valueField)->shouldBeCalled()->willReturn($form);

        $this->buildForm($event);
    }
}

