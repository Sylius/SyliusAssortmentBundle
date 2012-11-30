<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Form\DataTransformer;

use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\ResourceBundle\Manager\ResourceManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

/**
 * Product to id transformer.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductToIdentifierTransformer implements DataTransformerInterface
{
    /**
     * Product manager.
     *
     * @var ResourceManagerInterface
     */
    private $productManager;

    /**
     * Identifier.
     *
     * @var string
     */
    private $identifier;

    /**
     * Constructor.
     *
     * @param ResourceManagerInterface $productManager
     * @param string                  $identifier
     */
    public function __construct(ResourceManagerInterface $productManager, $identifier)
    {
        $this->productManager = $productManager;
        $this->identifier = $identifier;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        if (!$value instanceof ProductInterface) {
            throw new UnexpectedTypeException($value, 'Sylius\Bundle\AssortmentBundle\Model\ProductInterface');
        }

        return $value->{'get'.ucfirst($this->identifier)}();
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if (null === $value || '' === $value) {
            return null;
        }

        return $this->productManager->findOneBy(array($this->identifier => $value));
    }
}
