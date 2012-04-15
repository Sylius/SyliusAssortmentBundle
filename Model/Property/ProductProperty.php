<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Model\Property;

use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;

/**
 * Property to product relation.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductProperty implements ProductPropertyInterface
{
    /**
     * Id.
     *
     * @var integer
     */
    protected $id;

    /**
     * Product.
     *
     * @var ProductInterface
     */
    protected $product;

    /**
     * Property.
     *
     * @var PropertyInterface
     */
    protected $property;

    /**
     * Property value.
     *
     * @var mixed
     */
    protected $value;

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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * {@inheritdoc}
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * {@inheritdoc}
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * {@inheritdoc}
     */
    public function setProperty(PropertyInterface $property)
    {
        $this->property = $property;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        if (null === $this->property) {
            throw new \BadMethodCallException('The property have not been created yet so you cannot access proxy methods');
        }

        return $this->property->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getPresentation()
    {
        if (null === $this->property) {
            throw new \BadMethodCallException('The property have not been created yet so you cannot access proxy methods');
        }

        return $this->property->getPresentation();
    }
}
