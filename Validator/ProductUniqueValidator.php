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

use Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\AssortmentBundle\Model\ProductManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Unique product constraint validator.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductUniqueValidator extends ConstraintValidator
{
    /**
     * Product manager.
     *
     * @var ProductManagerInterface
     */
    protected $productManager;

    /**
     * Constructor.
     *
     * @param ProductManagerInterface $productManager
     */
    public function __construct(ProductManagerInterface $productManager)
    {
        $this->productManager = $productManager;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid($value, Constraint $constraint)
    {
        if (!$value instanceof ProductInterface) {
            throw new UnexpectedTypeException($value, 'Sylius\Bundle\AssortmentBundle\Model\ProductInterface');
        }

        if ($value instanceof CustomizableProductInterface && 'sku' === $constraint->property) {
            return true;
        }

        $product = $value;

        if (!$this->productManager->validateUnique($product, $constraint)) {
            $this->setMessage($constraint->message, array(
                '%property%' => $constraint->property
            ));

            return false;
        }

        return true;
    }
}
