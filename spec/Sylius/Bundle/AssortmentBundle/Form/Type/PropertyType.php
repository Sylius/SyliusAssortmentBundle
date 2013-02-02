<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Form\Type;

use PHPSpec2\ObjectBehavior;

/**
 * Property form type spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PropertyType extends ObjectBehavior
{
    function let()
    {
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
    function it_should_build_form_with_name_and_presentation_fields($builder)
    {
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
                        'boolean' => 'Boolean',
                        'string' => 'String',
                        'number' => 'Number',
                        'choice' => 'Choice',
                    )
                )
            )
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
