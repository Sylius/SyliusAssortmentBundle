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

use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\AssortmentBundle\Form\EventListener\BuildVariationTypeListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Product varition form type.
 * It can be used to display a form with option choices of given product.
 * The user picks the option he wants and submits the form.
 * You get the ready to store product variation that user wanted.
 *
 * This is best solution for ODM based backends of SyliusAssortmentBundle.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariationType extends AbstractType
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
     * @param string $dataClass FQCN of the product variation model
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
        if (!isset($options['product']) || !$options['product'] instanceof ProductInterface) {
            throw new FormException('You have to pass "Sylius\Bundle\AssortmentBundle\Model\ProductInterface" as "product" option to variation type');
        }

        if (!$options['master']) {
            $builder->addEventSubscriber(new BuildVariationTypeListener($options['product'], $builder->getFormFactory()));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        return array(
            'data_class' => $this->dataClass,
            'product'    => null
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_assortment_variant';
    }
}
