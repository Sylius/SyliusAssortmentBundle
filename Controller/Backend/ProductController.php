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

use Sylius\Bundle\AssortmentBundle\Controller\Controller;
use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterProductEvent;
use Sylius\Bundle\AssortmentBundle\EventDispatcher\SyliusAssortmentEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Product backend controller.
 * Here hides the slim code behind product related actions.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductController extends Controller
{
    /**
     * Shows a product.
     *
     * @param integer $id The product id
     *
     * @return Response
     */
    public function showAction($id)
    {
        $product = $this->findProductOr404($id);

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Product:show.html.'.$this->getEngine(), array(
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

        $paginator = $productManager->createPaginator($productSorter, !$request->query->get('deleted', false));
        $paginator->setCurrentPage($request->query->get('page', 1), true, true);

        $products = $paginator->getCurrentPageResults();

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Product:list.html.'.$this->getEngine(), array(
            'products'  => $products,
            'paginator' => $paginator,
            'sorter'    => $productSorter
        ));
    }

    /**
     * Creates a new product.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $product = $this->container->get('sylius_assortment.manager.product')->createProduct();
        $form = $this->container->get('form.factory')->create('sylius_assortment_product', $product);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PRODUCT_CREATE, new FilterProductEvent($product));
                $this->container->get('sylius_assortment.manipulator.product')->create($product);
                $this->setFlash('success', 'sylius_assortment.flash.product.created');

                return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_product_show', array(
                    'id' => $product->getId()
                )));
            }
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Product:create.html.'.$this->getEngine(), array(
            'form'    => $form->createView(),
            'product' => $product
        ));
    }

    /**
     * Updates a product.
     *
     * @param Request $request
     * @param integer $id The product id
     *
     * @return Response
     */
    public function updateAction(Request $request, $id)
    {
        $product = $this->findProductOr404($id);
        $form = $this->container->get('form.factory')->create('sylius_assortment_product', $product);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PRODUCT_UPDATE, new FilterProductEvent($product));
                $this->container->get('sylius_assortment.manipulator.product')->update($product);
                $this->setFlash('success', 'sylius_assortment.flash.product.updated');

                return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_product_show', array(
                    'id' => $product->getId()
                )));
            }
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Product:update.html.'.$this->getEngine(), array(
            'form'    => $form->createView(),
            'product' => $product
        ));
    }

    /**
     * Deletes products.
     *
     * @param integer $id The product id
     *
     * @return RedirectResponse
     */
    public function deleteAction($id)
    {
        $product = $this->findProductOr404($id);

        $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PRODUCT_DELETE, new FilterProductEvent($product));
        $this->container->get('sylius_assortment.manipulator.product')->delete($product);
        $this->setFlash('success', 'sylius_assortment.flash.product.deleted');

        return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_product_list'));
    }

    /**
     * Clones product and opens it for editing.
     *
     * @param integer $id The product id
     *
     * @return RedirectResponse
     */
    public function duplicateAction($id)
    {
        $product = $this->findProductOr404($id);

        $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PRODUCT_DUPLICATE, new FilterProductEvent($product));
        $duplicatedProduct = $this->container->get('sylius_assortment.manipulator.product')->duplicate($product);
        $this->setFlash('success', 'sylius_assortment.flash.product.duplicated');

        return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_product_update', array(
            'id' => $duplicatedProduct->getId()
        )));
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
