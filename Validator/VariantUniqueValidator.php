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
use Sylius\Bundle\ResourceBundle\Repository\ResourceRepositoryInterface;
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
     * @var ResourceRepositoryInterface
     */
    protected $variantRepository;

    /**
     * Constructor.
     *
     * @param ResourceRepositoryInterface $variantRepository
     */
    public function __construct(ResourceRepositoryInterface $variantRepository)
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

        $criteria = array($constraint->property => $variant->{'get'.ucfirst($constraint->property)}());

        if (!in_array($this->variantRepository->findOneBy($criteria), array(null, $variant))) {
            $this->setMessage($constraint->message, array(
                '%property%' => $constraint->property
            ));

            return false;
        }

        return true;
    }
}
