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
     * Creates paginator.
     *
     * @param array $options
     */
    function createPaginator(array $options = array());

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
     * @param array   $options
     *
     * @return ProductInterface
     */
    function findProduct($id, array $options = array());

    /**
     * Finds product by criteria.
     *
     * @param array $criteria
     * @param array $options
     *
     * @return ProductInterface
     */
    function findProductBy(array $criteria, array $options = array());

    /**
     * Finds all products.
     *
     * @param array $options
     *
     * @return array
     */
    function findProducts(array $options = array());

    /**
     * Finds products by criteria.
     *
     * @param array $criteria
     * @param array $options
     *
     * @return array
     */
    function findProductsBy(array $criteria, array $options = array());

    /**
     * Returns FQCN of product.
     *
     * @return string
     */
    function getClass();
}
