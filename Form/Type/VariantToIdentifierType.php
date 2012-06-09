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

use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantManagerInterface;
use Sylius\Bundle\AssortmentBundle\Form\DataTransformer\VariantToIdentifierTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\FormException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Variant to identifier type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantToIdentifierType extends AbstractType
{
    /**
     * Variant manager.
     *
     * @var VariantManagerInterface
     */
    private $variantManager;

    /**
     * See VariantType description for information about data class.
     *
     * @param VariantManagerInterface $variantManager
     */
    public function __construct(VariantManagerInterface $variantManager)
    {
        $this->variantManager = $variantManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new VariantToIdentifierTransformer($this->variantManager, $options['identifier']));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => null
            ))
            ->setRequired(array(
                'identifier'
            ))
            ->setAllowedTypes(array(
                'identifier' => array('string')
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_assortment_variant_to_identifier';
    }
}
