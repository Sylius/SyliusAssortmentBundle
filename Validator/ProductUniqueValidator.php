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
use Sylius\Bundle\ResourceBundle\Repository\ResourceRepositoryInterface;
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
     * @var ResourceRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param ResourceRepositoryInterface $repository
     */
    public function __construct(ResourceRepositoryInterface $repository)
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

        if ($product instanceof CustomizableProductInterface && 'sku' === $constraint->property) {
            return true;
        }

        $criteria = array($constraint->property => $product->{'get'.ucfirst($constraint->property)}());

        if (!in_array($this->repository->get($criteria), array(null, $product))) {
            $this->setMessage($constraint->message, array(
                '%property%' => $constraint->property
            ));

            return false;
        }

        return true;
    }
}
