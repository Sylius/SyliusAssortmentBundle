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
interface OptionInterface
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
     * Get internal name.
     *
     * @return string
     */
    function getName();

    /**
     * Set internal name.
     *
     * @param string $name
     */
    function setName($name);

    /**
     * The name displayed to user.
     *
     * @return string
     */
    function getPresentation();

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

