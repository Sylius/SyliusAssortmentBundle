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

use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;
use Sylius\Bundle\ResourceBundle\Manager\ResourceManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

/**
 * Variant to id transformer.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantToIdentifierTransformer implements DataTransformerInterface
{
    /**
     * Variant manager.
     *
     * @var ResourceManagerInterface
     */
    private $variantManager;

    /**
     * Identifier.
     *
     * @var string
     */
    private $identifier;

    /**
     * Constructor.
     *
     * @param ResourceManagerInterface $variantManager
     * @param string                  $identifier
     */
    public function __construct(ResourceManagerInterface $variantManager, $identifier)
    {
        $this->variantManager = $variantManager;
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

        if (!$value instanceof VariantInterface) {
            throw new UnexpectedTypeException($value, 'Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface');
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

        return $this->variantManager->findOneBy(array($this->identifier => $value));
    }
}
