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

/**
 * Product property interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface PropertyInterface
{
    /**
     * Get internal name.
     * It's used when editing product.
     *
     * @return string
     */
    public function getName();

    /**
     * Set internal name.
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * The name displayed to user.
     *
     * @return string
     */
    public function getPresentation();

    /**
     * Set presentation.
     *
     * @param string $presentation
     */
    public function setPresentation($presentation);

    /**
     * Get creation time.
     *
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * Set creation time.
     *
     * @param DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Set creation time to now.
     */
    public function incrementCreatedAt();

    /**
     * Get the time of last update.
     *
     * @return DateTime
     */
    public function getUpdatedAt();

    /**
     * Set last time update.
     *
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Set last update time to now.
     */
    public function incrementUpdatedAt();
}
