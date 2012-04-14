<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Variant;

/**
 * Variant manager interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface VariantManagerInterface
{
    /**
     * Creates new variant object.
     *
     * @return VariantInterface
     */
    function createVariant();

    /**
     * Persists variant.
     *
     * @param VariantInterface $variant
     */
    function persistVariant(VariantInterface $variant);

    /**
     * Deletes variant.
     *
     * @param VariantInterface $variant
     */
    function removeVariant(VariantInterface $variant);

    /**
     * Finds variant by id.
     *
     * @param integer $id
     *
     * @return VariantInterface
     */
    function findVariant($id);

    /**
     * Finds variant by criteria.
     *
     * @param array $criteria
     *
     * @return VariantInterface
     */
    function findVariantBy(array $criteria);

    /**
     * Finds all variants.
     *
     * @return array
     */
    function findVariants();

    /**
     * Finds variants by criteria.
     *
     * @param array $criteria
     *
     * @return array
     */
    function findVariantsBy(array $criteria);

    /**
     * Returns FQCN of variant.
     *
     * @return string
     */
    function getClass();
}
