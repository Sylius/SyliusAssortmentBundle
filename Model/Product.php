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
 * Model for products.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Product implements ProductInterface
{
    /**
     * Product id.
     *
     * @var mixed
     */
    protected $id;

    /**
     * Product SKU.
     *
     * @var string
     */
    protected $sku;

    /**
     * Product name.
     *
     * @var string
     */
    protected $name;

    /**
     * Permalink for the product.
     * Used in url to access it.
     *
     * @var string
     */
    protected $slug;

    /**
     * Product description.
     *
     * @var string
     */
    protected $description;

    /**
     * Available on.
     *
     * @var DateTime
     */
    protected $availableOn;

    /**
     * Creation time.
     *
     * @var DateTime
     */
    protected $createdAt;

    /**
     * Last update time.
     *
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * Deletion time.
     *
     * @var DateTime
     */
    protected $deletedAt;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->availableOn = new \DateTime("now");
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * {@inheritdoc}
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
      return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
      $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
      return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function isAvailable()
    {
        $now = new \DateTime("now");

        return $now > $this->availableOn;
    }

    /**
     * {@inheritdoc}
     */
    public function getAvailableOn()
    {
        return $this->availableOn;
    }

    /**
     * {@inheritdoc}
     */
    public function setAvailableOn(\DateTime $availableOn)
    {
        $this->availableOn = $availableOn;
    }

    /**
     * {@inheritdoc}
     */
    public function incrementAvailableOn()
    {
        $this->availableOn = new \DateTime("now");
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function incrementCreatedAt()
    {
        $this->createdAt = new \DateTime("now");
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function incrementUpdatedAt()
    {
        $this->updatedAt = new \DateTime("now");
    }

    /**
     * {@inheritdoc}
     */
    public function isDeleted()
    {
        return null !== $this->deletedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setDeletedAt(\DateTime $deletedAt)
    {
        $this->deletedAt = $updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function incrementDeletedAt()
    {
        $this->deletedAt = new \DateTime("now");
    }
}
