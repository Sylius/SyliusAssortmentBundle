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
use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;
use Symfony\Component\Form\Util\PropertyPath;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Unique product variant constraint validator.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantUniqueValidator extends ConstraintValidator
{
    /**
     * Variant manager.
     *
     * @var ObjectRepository
     */
    protected $variantRepository;

    /**
     * Constructor.
     *
     * @param ObjectRepository $variantRepository
     */
    public function __construct(ObjectRepository $variantRepository)
    {
        $this->variantRepository = $variantRepository;
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
        $propertyPath = new PropertyPath($constraint->property);

        $criteria = array($constraint->property => $propertyPath->getValue($variant));
        $conflictualVariant = $this->variantRepository->findOneBy($criteria);

        if (null !== $conflictualVariant && $conflictualVariant->getId() !== $variant->getId()) {
            $this->context->addViolationAtSubPath($constraint->property, $constraint->message, array(
                '%property%' => $constraint->property
            ));
        }
    }
}
