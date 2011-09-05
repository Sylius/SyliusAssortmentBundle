<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model;

/**
 * Product manager interface.
 * 
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface ProductManagerInterface
{
    /**
     * Creates new product object.
     * 
     * @return ProductInterface
     */
    function createProduct();

    /**
     * Persists product.
     * 
     * @param ProductInterface $product
     */
    function persistProduct(ProductInterface $product);
    
    /**
     * Deletes product.
     * 
     * @param ProductInterface $product
     */
    function removeProduct(ProductInterface $product);
    
    /**
     * Finds product by id.
     * 
     * @param integer $id
     * @return ProductInterface
     */
    function findProduct($id);
    
    /**
     * Finds product by criteria.
     * 
     * @param array $criteria
     * @return ProductInterface
     */
    function findProductBy(array $criteria);
    
    /**
     * Finds all products.
     * 
     * @return array
     */
    function findProducts();
    
    /**
     * Finds products by criteria.
     * 
     * @param array $criteria
     * @return array
     */
    function findProductsBy(array $criteria);
    
    /**
     * Returns FQCN of product.
     * 
     * @return string
     */
    function getClass();
    
    /**
     * Creates paginator.
     */
    function createPaginator();
}
