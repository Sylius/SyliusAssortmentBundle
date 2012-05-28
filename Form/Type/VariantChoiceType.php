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

use Sylius\Bundle\AssortmentBundle\Form\ChoiceList\VariantChoiceList;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\AssortmentBundle\SyliusAssortmentBundle;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\FormException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Variant choice form type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantChoiceType extends AbstractType
{
    /**
     * Bundle driver.
     *
     * @var string
     */
    protected $driver;

    /**
     * Constructor.
     *
     * @param string $driver The bundle driver
     */
    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!isset($options['product']) || !$options['product'] instanceof ProductInterface) {
            throw new FormException('You have to pass "Sylius\Bundle\AssortmentBundle\Model\ProductInterface" as "product" option to variant choice type');
        }

        if ($options['multiple'] && SyliusAssortmentBundle::DRIVER_DOCTRINE_ORM === $this->driver) {
            $builder->prependClientTransformer(new CollectionToArrayTransformer());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $choiceList = function (Options $options) {
            return new VariantChoiceList($options['product'], $options['availables']);
        };

        $resolver
            ->setDefaults(array(
                'product'     => null,
                'multiple'    => false,
                'expanded'    => true,
                'availables'  => true,
                'choice_list' => $choiceList
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_assortment_variant_choice';
    }
}
