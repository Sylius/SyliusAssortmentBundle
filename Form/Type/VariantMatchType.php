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

use Sylius\Bundle\AssortmentBundle\Form\DataTransformer\VariantToCombinationTransformer;
use Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\FormException;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Options;

/**
 * Variant choice form type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantChoiceType extends AbstractType
{
    /**
     * Option values combination to variant transformer.
     *
     * @var VariantToCombinationTransformer
     */
    protected $variantToCombinationTransformer;

    /**
     * Constructor.
     *
     * @param VariantToCombinationTransformer $variantToCombinationTransformer
     */
    public function __construct(VariantToCombinationTransformer $variantToCombinationTransformer)
    {
        $this->VariantToCombinationTransformer = $variantToCombinationTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        if (!isset($options['product']) || !$options['product'] instanceof CustomizableProductInterface) {
            throw new FormException('You have to pass "Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface" as "product" option to variant choice type');
        }

        foreach ($product->getOptions() as $i => $option) {
            $builder->add((string) $i, 'sylius_assortment_option_value_choice', array(
                'label'         => $option->getPresentation(),
                'option'        => $option,
                'property_path' => '['.$i.']'
            ));
        }

        $builder->prependClientTransformer($this->variantToCombinationTransformer);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        return array(
            'product'     => null,
            'multiple'    => false,
            'expanded'    => true,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_assortment_variant_match';
    }
}
