<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Validator;

use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Unique option values combination for variant.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class UniqueOptionValuesCombinationValidator extends ConstraintValidator
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
    public function isValid($value, Constraint $constraint)
    {
        if (!$value instanceof VariantInterface) {
            throw new UnexpectedTypeException($value, 'Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface');
        }

        $variant = $value;
        $product = $variant->getProduct();

        if (0 === $product->countVariants()) {

            return true;
        }

        $combination = array();

        foreach ($variant->getOptions() as $option) {
            $combination[] = $option;
        }

        foreach ($product->getVariants() as $existingVariant) {
            if ($variant !== $existingVariant) {
                $matches = true;

                foreach ($combination as $option) {
                    if (!$existingVariant->hasOption($option)) {
                        $matches = false;
                    }
                }

                if ($matches) {
                    break;
                }
            }
        }

        if ($matches) {
            $this->setMessage($constraint->message);

            return false;
        }

        return true;
    }
}
