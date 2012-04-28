<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Product prototype form type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PrototypeType extends AbstractType
{
    /**
     * Data class.
     *
     * @var string
     */
    protected $dataClass;

    /**
     * Constructor.
     *
     * @param string $dataClass FQCN of the prototype model
     */
    public function __construct($dataClass)
    {
        $this->dataClass = $dataClass;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'sylius_assortment.label.prototype.name'
            ))
            ->add('properties', 'sylius_assortment_property_choice', array(
                'required' => false,
                'multiple' => true,
                'label'    => 'sylius_assortment.label.prototype.properties'
            ))
            ->add('options', 'sylius_assortment_option_choice', array(
                'required' => false,
                'multiple' => true,
                'label'    => 'sylius_assortment.label.prototype.options'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        return array(
            'data_class' => $this->dataClass,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_assortment_prototype';
    }
}
