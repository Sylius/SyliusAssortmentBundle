<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Variant controller.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@sylius.pl>
 */
class VariantController extends ResourceController
{
    /**
     * Generate all possible variants for given product id.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function generateAction(Request $request)
    {
        if (null === $productId = $request->get('productId')) {
            throw new NotFoundHttpException('No product given');
        }

        $product = $this
            ->getProductController()
            ->findOr404(array('id' => $productId))
        ;

        $this
            ->getGenerator()
            ->generate($product)
        ;

        $this->persistAndFlush($product);

        return $this
            ->getProductController()
            ->redirectTo($product)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        if (null === $productId = $this->getRequest()->get('productId')) {
            throw new NotFoundHttpException('No parent product given');
        }

        $product = $this
            ->getProductController()
            ->findOr404(array('id' => $productId))
        ;

        $variant = parent::createNew();
        $variant->setProduct($product);

        return $variant;
    }

    /**
     * Get product controller.
     *
     * @return ResourceController
     */
    protected function getProductController()
    {
        return $this->get('sylius_assortment.controller.product');
    }

    /**
     * Get variant generator.
     *
     * @return VariantGeneratorInterface
     */
    protected function getGenerator()
    {
        return $this->getService('generator');
    }
}
