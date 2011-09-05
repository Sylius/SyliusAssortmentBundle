<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Form\DataTransformer;

use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\DataTransformerInterface;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\AssortmentBundle\Model\ProductManagerInterface;

/**
 * Product to id transformer.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@sylius.pl>
 */
class ProductToIdTransformer implements DataTransformerInterface
{
    /**
     * Product manager.
     * 
     * @var ProductManagerInterface
     */
    protected $productManager;
    
    /**
     * Constructor.
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
    public function transform($value)
    {
        if (null == $value) {
            return null;
        }
        
        if (!$value instanceof ProductInterface) {
            throw new UnexpectedTypeException($value, 'Sylius\Bundle\AssortmentBundle\Model\ProductInterface');
        }
        
        return $value->getId();
    }
    
    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if ($value == null || $value == '') {
            return null;
        }
        
        if (!is_numeric($value)) {
            throw new UnexpectedTypeException($value, 'numeric');
        }
        
        $product = $this->productManager->findProduct($value);
        
        if (!$product) {
            throw new TransformationFailedException('Product with given id does not exist.');
        }
        
        return $product;
    }
}
