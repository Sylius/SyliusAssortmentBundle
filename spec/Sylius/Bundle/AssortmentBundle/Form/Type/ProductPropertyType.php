<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Form\Type;

use PHPSpec2\ObjectBehavior;

/**
 * ProductProperty form type spec.
 *
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
class ProductPropertyType extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('ProductProperty');
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Form\Type\ProductPropertyType');
    }

    function it_should_be_a_form_type()
    {
        $this->shouldImplement('Symfony\Component\Form\FormTypeInterface');
    }

    /**
     * @param Symfony\Component\Form\FormBuilder $builder
     * @param Symfony\Component\Form\FormFactoryInterface $formFactory
     */
    function it_should_build_fields_dynamically_using_build_product_property_listener($builder, $formFactory)
    {
        $builder->getFormFactory()->willReturn($formFactory)->shouldBeCalled();
        $builder->add(ANY_ARGUMENTS)->willReturn($builder);
        $builder
            ->addEventSubscriber(\Mockery::type('Sylius\Bundle\AssortmentBundle\Form\EventListener\BuildProductPropertyFormListener'))
            ->shouldBeCalled();
        ;

        $this->buildForm($builder, array());
    }

    /**
     * @param Symfony\Component\Form\FormBuilder $builder
     * @param Symfony\Component\Form\FormFactoryInterface $formFactory
     */
    function it_should_build_property_field($builder, $formFactory)
    {
        $builder->getFormFactory()->willReturn($formFactory);
        $builder->add('property', 'sylius_property_choice')->willReturn($builder)->shouldBeCalled();
        $builder
            ->addEventSubscriber(ANY_ARGUMENTS)
            ->willReturn($builder)
        ;

        $this->buildForm($builder, array());
    }

    /**
     * @param Symfony\Component\Form\FormBuilder $builder
     * @param Symfony\Component\Form\FormBuilder $fieldBuilder
     * @param Symfony\Component\Form\FormFactoryInterface $formFactory
     * @param Sylius\Bundle\AssortmentBundle\Form\ChoiceList\PropertyChoiceList $choiceList
     * @param Sylius\Bundle\AssortmentBundle\Model\Property\PropertyInterface $property
     */
    function it_should_build_property_types_prototype_and_pass_it_as_argument(
        $builder, $fieldBuilder, $formFactory, $choiceList, $property
    )
    {
        $builder->getFormFactory()->willReturn($formFactory);
        $builder->add(ANY_ARGUMENTS)->willReturn($builder);
        $builder
            ->addEventSubscriber(ANY_ARGUMENTS)
            ->willReturn($builder)
        ;

        $property->getId()->willReturn(1)->shouldBeCalled();
        $property->getType()->willReturn('checkbox')->shouldBeCalled();

        $choiceList
            ->getChoices()
            ->willReturn(array($property))
        ;
        $fieldBuilder
            ->getOption('choice_list')
            ->willReturn($choiceList)
        ;
        $builder
            ->get('property')
            ->willReturn($fieldBuilder)
        ;
        $builder
            ->create('value', 'checkbox')
            ->willReturn($fieldBuilder)
        ;
        $fieldBuilder->getForm()->willReturn('form for property');

        $builder->setAttribute('prototypes', array(1 => 'form for property'))->shouldBeCalled();

        $this->buildForm($builder, array());
    }

    /**
     * @param Symfony\Component\Form\FormView $view
     * @param Symfony\Component\Form\Form $form
     * @param Symfony\Component\Form\Form $prototypeForm
     * @param Symfony\Component\Form\FormBuilder $builder
     */
    function it_should_pass_prototypes_from_arguments_to_view($view, $form, $prototypeForm, $builder)
    {
        $builder->getAttribute('prototypes', array())->willReturn(array('some name' => $prototypeForm))->shouldBeCalled();
        $form->getConfig()->willReturn($builder)->shouldBeCalled();
        $prototypeForm->createView($view)->shouldBeCalled()->willReturn('form view');

        $this->buildView($view, $form, array());
    }

    /**
     * @param Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    function it_should_define_assigned_data_class($resolver)
    {
        $resolver->setDefaults(array('data_class' => 'ProductProperty'))->shouldBeCalled();

        $this->setDefaultOptions($resolver);
    }

    function it_should_have_valid_name()
    {
        $this->getName()->shouldReturn('sylius_product_property');
    }
}
