<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Builder;

use Doctrine\Common\Persistence\ObjectRepository;
use Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface;
use Sylius\Bundle\AssortmentBundle\Model\Prototype\PrototypeInterface;

/**
 * Prototype builder.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PrototypeBuilder implements PrototypeBuilderInterface
{
    protected $productPropertyRepository;

    public function __construct(ObjectRepository $productPropertyRepository)
    {
        $this->productPropertyRepository = $productPropertyRepository;
    }

    public function build(PrototypeInterface $prototype, CustomizableProductInterface $product)
    {
        foreach ($prototype->getOptions() as $option) {
            $product->addOption($option);
        }

        foreach ($prototype->getProperties() as $property) {
            $productProperty = $this->productPropertyRepository->createNew();
            $productProperty->setProperty($property);

            $product->addProperty($productProperty);
        }
    }
}
