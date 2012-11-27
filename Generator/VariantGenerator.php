<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Generator;

use Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface;
use Sylius\Bundle\ResourceBundle\Manager\ResourceManagerInterface;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Variant generator.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantGenerator implements VariantGeneratorInterface
{
    /**
     * Validator.
     *
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * Variant manager.
     *
     * @var ResourceManagerInterface
     */
    protected $variantManager;

    /**
     * Constructor.
     *
     * @param ValidatorInterface      $validator
     * @param ResourceManagerInterface $variantManager
     */
    public function __construct(ValidatorInterface $validator, ResourceManagerInterface $variantManager)
    {
        $this->validator = $validator;
        $this->variantManager = $variantManager;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(CustomizableProductInterface $product)
    {
        $optionSet = array();
        $optionMap = array();

        foreach ($product->getOptions() as $k => $option) {
            foreach ($option->getValues() as $value) {
                $optionSet[$k][] = $value->getId();
                $optionMap[$value->getId()] = $value;
            }
        }

        $permutations = $this->getPermutations($optionSet);

        foreach ($permutations as $i => $permutation) {
            $variant = $this->variantManager->create();
            $variant->setProduct($product);

            $variant->setSku($product->getSku().'-'.($i + 1));
            $variant->setAvailableOn(new \DateTime('+1 hour'));

            if (is_array($permutation)) {
                foreach ($permutation as $id) {
                    $variant->addOption($optionMap[$id]);
                }
            } else {
                $variant->addOption($optionMap[$permutation]);
            }

            $product->addVariant($variant);

            if (0 < count($this->validator->validate($variant))) {
                $product->removeVariant($variant);
            }
        }
    }

    /**
     * Get all permutations of option set.
     * Cartesian product.
     *
     * @param array   $array
     * @param Boolean $recursing
     *
     * @return array
     */
    protected function getPermutations($array, $recursing = false)
    {
        $countArrays = count($array);

        if (1 === $countArrays) {

            return reset($array);
        } elseif (0 === $countArrays) {
            throw new \InvalidArgumentException('At least one array is required');
        }

        $keys = array_keys($array);

        $a = array_shift($array);
        $k = array_shift($keys);

        $b = $this->getPermutations($array, true);

        $result = array();

        foreach ($a as $valueA) {
            if ($valueA) {
                foreach ($b as $valueB) {
                    if ($recursing) {
                        $result[] = array_merge(array($valueA), (array) $valueB);
                    } else {
                        $result[] = array($k => $valueA) + array_combine($keys, (array) $valueB);
                    }
                }
            }
        }

        return $result;
    }
}
