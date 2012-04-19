<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Controller\Api;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\View\View;

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

        $view = View::create()
            ->setData($product)
        ;

        return $this->handleView($view);
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

        $paginator = $productManager->createPaginator();
        $paginator->setCurrentPage($request->query->get('page', 1), true, true);
        $paginator->setMaxPerPage($request->query->get('limit', 10));

        $products = $paginator->getCurrentPageResults();

        $view = View::create()
            ->setData($products)
        ;

        return $this->handleView($view);
    }

    /**
     * Handles view.
     *
     * @param View $view
     *
     * @return Response
     */
    protected function handleView(View $view)
    {
        return $this->container->get('fos_rest.view_handler')->handle($view);
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
