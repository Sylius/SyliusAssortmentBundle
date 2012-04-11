<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Option;

/**
 * Option manager interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface OptionManagerInterface
{
    /**
     * Creates new option object.
     *
     * @return OptionInterface
     */
    function createOption();

    /**
     * Persists option.
     *
     * @param OptionInterface $option
     */
    function persistOption(OptionInterface $option);

    /**
     * Deletes option.
     *
     * @param OptionInterface $option
     */
    function removeOption(OptionInterface $option);

    /**
     * Finds option by id.
     *
     * @param integer $id
     *
     * @return OptionInterface
     */
    function findOption($id);

    /**
     * Finds option by criteria.
     *
     * @param array $criteria
     *
     * @return OptionInterface
     */
    function findOptionBy(array $criteria);

    /**
     * Finds all options.
     *
     * @return array
     */
    function findOptions();

    /**
     * Finds options by criteria.
     *
     * @param array $criteria
     *
     * @return array
     */
    function findOptionsBy(array $criteria);

    /**
     * Returns FQCN of option.
     *
     * @return string
     */
    function getClass();
}
