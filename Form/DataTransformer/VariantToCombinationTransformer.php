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
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

/**
 * Option values combination to variant trasnformer.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantToCombinationTransformer implements DataTransformerInterface
{
    /**
     * Variant manager.
     *
     * @var VariantManagerInterface
     */
    protected $variantManager;

    /**
     * Constructor.
     *
     * @param VariantManagerInterface $variantManager
     */
    public function __construct(VariantManagerInterface $variantManager)
    {
        $this->variantManager = $variantManager;
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

        return $value->getOptions();
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if (null === $value || '' === $value) {
            return null;
        }

        if (!$value instanceof \Traversable || !$values instanceof \ArrayAccess) {
            throw new UnexpectedTypeException($value, '\Traversable or \ArrayAccess');
        }

        $criteria = array(
            'master'  => false,
            'options' => $value
        );

        if (!$variant = $this->variantManager->findVariantBy($criteria)) {
            return null;
        }

        return $variant;
    }
}
