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
use Symfony\Component\Form\AbstractType;
use Sylius\Bundle\AssortmentBundle\Form\DataTransformer\ProductToIdTransformer;

/**
 * Product hidden type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductFormType extends AbstractType
{
    /**
     * Data class.
     * 
     * @var string
     */
    protected $dataClass;
    
    /**
     * Product to id transformer.
     * 
     * @var ProductToIdTransformer
     */
    protected $productToIdTransformer;
    
    public function __construct($dataClass, ProductToIdTransformer $productToIdTransformer)
    {
        $this->dataClass = $dataClass;
        $this->productToIdTransformer = $productToIdTransformer;
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->prependClientTransformer($this->productToIdTransformer);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => $this->dataClass,
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function getParent(array $options)
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
