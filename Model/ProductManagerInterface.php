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

use Sylius\Bundle\AssortmentBundle\Sorting\SorterInterface;

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
     * @param SorterInterface $sorter
     * @param Boolean         $filterDeleted Whether to filter deleted products or not
     *
     * @return Pagerfanta
     */
    function createPaginator(SorterInterface $sorter, $filterDeleted = true);

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
     * @param Boolean $filterDeleted Whether to filter deleted products or not
     *
     * @return ProductInterface
     */
    function findProduct($id, $filterDeleted = true);

    /**
     * Finds product by criteria.
     *
     * @param array   $criteria
     * @param Boolean $filterDeleted Whether to filter deleted products or not
     *
     * @return ProductInterface
     */
    function findProductBy(array $criteria, $filterDeleted = true);

    /**
     * Finds all products.
     *
     * @param Boolean $filterDeleted Whether to filter deleted products or not
     *
     * @return array
     */
    function findProducts($filterDeleted = true);

    /**
     * Finds products by criteria.
     *
     * @param array   $criteria
     * @param Boolean $filterDeleted Whether to filter deleted products or not
     *
     * @return array
     */
    function findProductsBy(array $criteria, $filterDeleted = true);

    /**
     * Returns FQCN of product.
     *
     * @return string
     */
    function getClass();
}
