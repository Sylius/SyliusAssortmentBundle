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

use Sylius\Bundle\AssortmentBundle\Model\ProductManagerInterface;
use Sylius\Bundle\AssortmentBundle\Form\DataTransformer\ProductToIdentifierTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Product hidden type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductHiddenType extends AbstractType
{
    /**
     * Product manager.
     *
     * @var ProductManagerInterface
     */
    private $productManager;

    /**
     * See ProductType description for information about data class.
     *
     * @param ProductManagerInterface $productManager
     */
    public function __construct(ProductManagerInterface $productManager)
    {
        $this->productManager = $productManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new ProductToIdentifierTransformer($this->productManager, 'id'));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'hidden';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_assortment_product_hidden';
    }
}
