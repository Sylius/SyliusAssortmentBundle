<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Form\EventListener;

use PHPSpec2\ObjectBehavior;

class BuildPropertyFormChoicesListener extends ObjectBehavior
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
        self::getSubscribedEvents()->shouldReturn(array('form.pre_set_data' => 'buildChoices'));
    }

    /**
     * @param Symfony\Component\Form\Event\DataEvent $event
     * @param Symfony\Component\Form\Form $form
     */
    function it_should_not_build_choices_collection_for_null(
        $event, $form, $formFactory
    )
    {
        $event->getData()->willReturn(null);
        $event->getForm()->willReturn($form);

        $formFactory
            ->createNamed(ANY_ARGUMENTS)
            ->shouldNotBeCalled()
        ;
        $form->add(ANY_ARGUMENTS)->shouldNotBeCalled();

        $this->buildChoices($event);
    }

    /**
     * @param Symfony\Component\Form\Event\DataEvent $event
     * @param Symfony\Component\Form\Form $form
     * @param Sylius\Bundle\AssortmentBundle\Model\PropertyInterface $property
     * @param Symfony\Component\Form\Form $collectionField
     */
    function it_should_build_choices_collection_for_new_object_without_type(
        $event, $form, $property, $collectionField, $formFactory
    )
    {
        $property->getId()->willReturn(null);
        $event->getData()->willReturn($property);
        $event->getForm()->willReturn($form);

        $formFactory
            ->createNamed('choices', 'collection', null, array(
                'type'         => 'text',
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false
            ))
            ->willReturn($collectionField)
            ->shouldBeCalled()
        ;
        $form->add($collectionField)->shouldBeCalled()->willReturn($form);

        $this->buildChoices($event);
    }

    /**
     * @param Symfony\Component\Form\Event\DataEvent $event
     * @param Symfony\Component\Form\Form $form
     * @param Sylius\Bundle\AssortmentBundle\Model\PropertyInterface $property
     * @param Symfony\Component\Form\Form $collectionField
     */
    function it_should_build_choices_collection_for_choice_property(
        $event, $form, $property, $collectionField, $formFactory
    )
    {
        $property->getId()->willReturn(1);
        $property->getType()->willReturn('choice');

        $event->getData()->willReturn($property);
        $event->getForm()->willReturn($form);

        $formFactory
            ->createNamed('choices', 'collection', null, array(
                'type'         => 'text',
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false
            ))
            ->willReturn($collectionField)
            ->shouldBeCalled()
        ;
        $form->add($collectionField)->shouldBeCalled()->willReturn($form);

        $this->buildChoices($event);
    }

    /**
     * @param Symfony\Component\Form\Event\DataEvent $event
     * @param Symfony\Component\Form\Form $form
     * @param Sylius\Bundle\AssortmentBundle\Model\PropertyInterface $property
     * @param Symfony\Component\Form\Form $collectionField
     */
    function it_should_not_build_choices_collection_for_other_than_choice_property_types(
        $event, $form, $property, $collectionField, $formFactory
    )
    {
        $property->getId()->willReturn(1);
        $property->getType()->willReturn('text');

        $event->getData()->willReturn($property);
        $event->getForm()->willReturn($form);

        $formFactory
            ->createNamed('choices', 'collection', null, ANY_ARGUMENT)
            ->willReturn($collectionField)
            ->shouldNotBeCalled()
        ;
        $form->add(ANY_ARGUMENTS)->shouldNotBeCalled();

        $this->buildChoices($event);
    }
}
