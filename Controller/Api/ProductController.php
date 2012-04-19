<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Controller\Backend;

use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterProductEvent;
use Sylius\Bundle\AssortmentBundle\EventDispatcher\SyliusAssortmentEvents;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Product API controller.
 * Currently supports only reading resources.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductController extends ContainerAware
{
    /**
     * GET product by id.
     *
     * @param integer $id The product id
     *
     * @return Reponse
     */
    public function getProductAction($id)
    {
        $product = $this->findProductOr404($id);
    }

    /**
     * GET products.
     *
     * @param Request $request
     *
     * @return Reponse
     */
    public function getProductsAction(Request $request)
    {
        $productManager = $this->container->get('sylius_assortment.manager.product');
        $productSorter = $this->container->get('sylius_assortment.sorter.product');

        $paginator = $productManager->createPaginator($productSorter, !$request->query->get('deleted', false));
        $paginator->setCurrentPage($request->query->get('page', 1), true, true);

        $products = $paginator->getCurrentPageResults();
    }

    /**
     * Tries to find product with given id.
     * Throws a special http exception with code 404 if unsuccessful.
     *
     * @param integer $id The product id
     *
     * @return ProductInterface
     *
     * @throws NotFoundHttpException
     */
    protected function findProductOr404($id)
    {
        if (!$product = $this->container->get('sylius_assortment.manager.product')->findProduct($id)) {
            throw new NotFoundHttpException('Requested product does not exist');
        }

        return $product;
    }

}
