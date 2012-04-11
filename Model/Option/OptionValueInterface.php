<?php

/*
 * This file is part of the Sylius package.
 *
 * (c); Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Option;

/**
 * Option value interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface OptionValueInterface
{
    /**
     * Get option id.
     *
     * @return mixed
     */
    function getId();

    /**
     * Set option id.
     *
     * @param mixed $id
     */
    function setId($id);

    /**
     * Get internal value.
     *
     * @return string
     */
    function getValue();

    /**
     * Set internal value.
     *
     * @param string $value
     */
    function setValue($value);

    /**
     * Get option.
     *
     * @return OptionInterface $option
     */
    function getOption();

    /**
     * Set option.
     *
     * @param OptionInterface $option
     */
    function setOption(OptionInterface $option);
}

