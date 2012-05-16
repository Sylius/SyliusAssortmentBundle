<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Prototype;

use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;

/**
 * Prototype manager interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface PrototypeManagerInterface
{
    /**
     * Creates new prototype object.
     *
     * @return PrototypeInterface
     */
    function createPrototype();

    /**
     * Builds product based on prototype.
     *
     * @param PrototypeInterface    $prototype
     * @param ProductInterface      $product
     * @param string                $productPropertyClass
     * @return ProductInterface
     */
    function buildPrototype(PrototypeInterface $prototype, ProductInterface $product, $productPropertyClass);

    /**
     * Persists prototype.
     *
     * @param PrototypeInterface $prototype
     */
    function persistPrototype(PrototypeInterface $prototype);

    /**
     * Deletes prototype.
     *
     * @param PrototypeInterface $prototype
     */
    function removePrototype(PrototypeInterface $prototype);

    /**
     * Finds prototype by id.
     *
     * @param integer $id
     *
     * @return PrototypeInterface
     */
    function findPrototype($id);

    /**
     * Finds prototype by criteria.
     *
     * @param array $criteria
     *
     * @return PrototypeInterface
     */
    function findPrototypeBy(array $criteria);

    /**
     * Finds all prototypes.
     *
     * @return array
     */
    function findPrototypes();

    /**
     * Finds prototypes by criteria.
     *
     * @param array $criteria
     *
     * @return array
     */
    function findPrototypesBy(array $criteria);

    /**
     * Returns FQCN of prototype.
     *
     * @return string
     */
    function getClass();
}
