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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Product backend controller.
 * Here hides the slim code behind product related actions.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductController extends ContainerAware
{
    /**
     * Shows a product.
     *
     * @param integer $id The product id
     */
    public function showAction($id)
    {
        $product = $this->findProductOr404($id);

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Product:show.html.' . $this->getEngine(), array(
            'product' => $product
        ));
    }

    /**
     * Lists paginated products.
     */
    public function listAction()
    {
        $productManager = $this->container->get('sylius_assortment.manager.product');

        $productSorter = $this->container->get('sylius_assortment.sorter.product');

        $paginator = $productManager->createPaginator($productSorter);
        $paginator->setCurrentPage($this->container->get('request')->query->get('page', 1), true, true);

        $products = $paginator->getCurrentPageResults();

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Product:list.html.' . $this->getEngine(), array(
            'products'  => $products,
            'paginator' => $paginator,
            'sorter'    => $productSorter
        ));
    }

    /**
     * Creates a new product.
     */
    public function createAction()
    {
        $request = $this->container->get('request');

        $product = $this->container->get('sylius_assortment.manager.product')->createProduct();

        $form = $this->container->get('form.factory')->create($this->container->get('sylius_assortment.form.type.product'));
        $form->setData($product);

        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PRODUCT_CREATE, new FilterProductEvent($product));
                $this->container->get('sylius_assortment.manipulator.product')->create($product);

                return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_product_show', array(
                    'id' => $product->getId()
                )));
            }
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Product:create.html.' . $this->getEngine(), array(
            'form' => $form->createView()
        ));
    }

    /**
     * Updates a product.
     *
     * @param integer $id The product id
     */
    public function updateAction($id)
    {
        $product = $this->findProductOr404($id);

        $request = $this->container->get('request');

        $form = $this->container->get('form.factory')->create($this->container->get('sylius_assortment.form.type.product'));
        $form->setData($product);

        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PRODUCT_UPDATE, new FilterProductEvent($product));
                $this->container->get('sylius_assortment.manipulator.product')->update($product);

                return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_product_show', array(
                    'id' => $product->getId()
                )));
            }
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Product:update.html.' . $this->getEngine(), array(
            'form' => $form->createView(),
            'product' => $product
        ));
    }

    /**
     * Deletes products.
     *
     * @param integer $id The product id
     */
    public function deleteAction($id)
    {
        $product = $this->findProductOr404($id);

        $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PRODUCT_DELETE, new FilterProductEvent($product));
        $this->container->get('sylius_assortment.manipulator.product')->delete($product);

        return new RedirectResponse($this->container->get('request')->headers->get('referer'));
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
            throw new NotFoundHttpException('Requested product does not exist.');
        }

        return $product;
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
