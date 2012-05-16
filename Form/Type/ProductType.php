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
 * Product form type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductType extends AbstractType
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
     * It's important to set the data class that was configured inside 'config.yml'.
     * This will be done automatically when using this class, but if you would like to extend it,
     * remember to pass '%sylius_assortment.model.product.class%' as an argument inside service definition.
     *
     * @param string $dataClass FQCN of the product model
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
            ->add('sku', 'text', array(
                'label' => 'sylius_assortment.label.product.sku'
            ))
            ->add('name', 'text', array(
                'label' => 'sylius_assortment.label.product.name'
            ))
            ->add('description', 'textarea', array(
                'label' => 'sylius_assortment.label.product.description'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        return array(
            'prototype' => null,
            'data_class' => $this->dataClass,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_assortment_product';
    }
}
