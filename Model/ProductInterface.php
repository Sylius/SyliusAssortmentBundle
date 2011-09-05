<?php

/*
 * This file is part of the Sylius package.
 *
 * (c); Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model;

/**
 * Product interface.
 * 
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface ProductInterface
{
    function getId();
    function getName();
    function setName($name);
    function getSlug();
    function setSlug($slug);
    function getDescription();
    function setDescription($description);
    function getCreatedAt();
    function incrementCreatedAt();
    function getUpdatedAt();
    function incrementUpdatedAt();
}