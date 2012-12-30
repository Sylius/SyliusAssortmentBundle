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

use Doctrine\Common\Persistence\ObjectRepository;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface;
use Symfony\Component\Form\Util\PropertyPath;
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
     * @var ObjectRepository
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param ObjectRepository $repository
     */
    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid($value, Constraint $constraint)
    {
        if (!$value instanceof ProductInterface) {
            throw new UnexpectedTypeException($value, 'Sylius\Bundle\AssortmentBundle\Model\ProductInterface');
        }

        $product = $value;
        $propertyPath = new PropertyPath($constraint->property);

        // Avoid double validation of SKU on customizable products.
        if ('sku' === $constraint->property && $product instanceof CustomizableProductInterface) {
            return;
        }

        $criteria = array($constraint->property => $propertyPath->getValue($product));
        $conflictualProduct = $this->repository->findOneBy($criteria);

        if (null !== $conflictualProduct && $conflictualProduct->getId() !== $product->getId()) {
            $this->context->addViolationAtSubPath($constraint->property, $constraint->message, array(
                '%property%' => $constraint->property
            ));
        }
    }
}
