<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Controller\Frontend;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Product frontend controller.
 * Provides simple actions to list paginated products and to
 * display specific one by slug.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductController extends ContainerAware
{
    /**
     * Shows single product page.
     *
     * @param string $slug The product slug
     *
     * @return Response
     */
    public function showAction($slug)
    {
        $product = $this->container->get('sylius_assortment.manager.product')->findProductBy(array('slug' => $slug));

        if (!$product || !$product->isAvailable()) {
            throw new NotFoundHttpException('Requested product does not exist');
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Frontend/Product:show.html.'.$this->getEngine(), array(
            'product' => $product
        ));
    }

    /**
     * Lists paginated products.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function listAction(Request $request)
    {
        $productManager = $this->container->get('sylius_assortment.manager.product');
        $productSorter = $this->container->get('sylius_assortment.sorter.product');

        $paginator = $productManager->createPaginator($productSorter);
        $paginator->setCurrentPage($request->query->get('page', 1), true, true);

        $products = $paginator->getCurrentPageResults();

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Frontend/Product:list.html.'.$this->getEngine(), array(
            'products'  => $products,
            'paginator' => $paginator
        ));
    }

    /**
     * Returns templating engine name.
     *
     * @return string
     */
    protected function getEngine()
    {
        return $this->container->getParameter('sylius_assortment.engine');
    }
}
