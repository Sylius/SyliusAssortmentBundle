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

use Symfony\Component\Form\FormBuilder;

/**
 * Fluid product form type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class FluidProductType extends ProductType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('options', 'sylius_assortment_option_choice', array(
                'required' => false,
                'multiple' => true
            ))
            ->add('properties', 'collection', array(
                'required'  => false,
                'type'      => 'text',
                'allow_add' => true,
            ))
        ;
    }
}
