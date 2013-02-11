<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Form\Type;

use PHPSpec2\ObjectBehavior;

/**
 * Property form type spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 * @author Leszek Prabucki <leszek.prabucki@gmail.pl>
 */
class PropertyType extends ObjectBehavior
{
    /**
     * @param Symfony\Component\Form\FormBuilder $builder
     * @param Symfony\Component\Form\FormFactoryInterface $formFactory
     */
    function let($builder, $formFactory)
    {
        $builder->getFormFactory()->willReturn($formFactory);
        $this->beConstructedWith('Property');
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Form\Type\PropertyType');
    }

    function it_should_be_a_form_type()
    {
        $this->shouldImplement('Symfony\Component\Form\FormTypeInterface');
    }

    /**
     * @param Symfony\Component\Form\FormBuilder $builder
     */
    function it_should_build_form($builder)
    {
        $builder
            ->addEventSubscriber(ANY_ARGUMENTS)
            ->willReturn($builder)
        ;

        $builder
            ->add('name', 'text', ANY_ARGUMENT)
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $builder
            ->add('presentation', 'text', ANY_ARGUMENT)
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $builder
            ->add(
                'type',
                'choice',
                array(
                    'choices' => array(
                        'checkbox' => 'Boolean',
                        'text'     => 'String',
                        'number'   => 'Number',
                        'choice'   => 'Choice',
                    )
                )
            )
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $this->buildForm($builder, array());
    }

    /**
     * @param Symfony\Component\Form\FormBuilder $builder
     */
    function it_should_build_choices_type_for_product_property_type($builder, $formFactory)
    {
        $builder->add(ANY_ARGUMENTS)->willReturn($builder);
        $builder
            ->addEventSubscriber(\Mockery::type('Sylius\Bundle\AssortmentBundle\Form\EventListener\BuildPropertyFormChoicesListener'))
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $this->buildForm($builder, array());
    }

    /**
     * @param Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    function it_should_define_assigned_data_class($resolver)
    {
        $resolver->setDefaults(array('data_class' => 'Property'))->shouldBeCalled();

        $this->setDefaultOptions($resolver);
    }
}
