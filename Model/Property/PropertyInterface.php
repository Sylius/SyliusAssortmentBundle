<?php

/*
 * This file is part of the Sylius package.
 *
 * (c); Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Property;

use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;

/**
 * Product property interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface PropertyInterface
{
    /**
     * Get property id.
     *
     * @return mixed
     */
    function getId();

    /**
     * Set property id.
     *
     * @param mixed $id
     */
    function setId($id);

    /**
     * Get internal name.
     * It's used when editing product.
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
     * Set presentation.
     *
     * @param string $presentation
     */
    function setPresentation($presentation);

    /**
     * Get creation time.
     *
     * @return DateTime
     */
    function getCreatedAt();

    /**
     * Set creation time.
     *
     * @param DateTime $createdAt
     */
    function setCreatedAt(\DateTime $createdAt);

    /**
     * Set creation time to now.
     */
    function incrementCreatedAt();

    /**
     * Get the time of last update.
     *
     * @return DateTime
     */
    function getUpdatedAt();

    /**
     * Set last time update.
     *
     * @param DateTime $updatedAt
     */
    function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Set last update time to now.
     */
    function incrementUpdatedAt();
}
