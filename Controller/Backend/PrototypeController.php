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
use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterPrototypeEvent;
use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterProductEvent;
use Sylius\Bundle\AssortmentBundle\EventDispatcher\SyliusAssortmentEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Product prototype backend controller.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PrototypeController extends Controller
{
    /**
     * Creates a new product based on given prototype, displays creation form.
     *
     * @param Request $request
     * @param mixed   $id      Prototype id
     *
     * @return Response
     */
    public function buildAction(Request $request, $id)
    {
        $prototype = $this->findPrototypeOr404($id);
        $product = $this->container->get('sylius_assortment.manager.product')->createProduct();

        $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PROTOTYPE_BUILD, new FilterPrototypeEvent($prototype));
        $this->container->get('sylius_assortment.manager.prototype')->buildPrototype($prototype, $product);
        $form = $this->container->get('form.factory')->create('sylius_assortment_product', $product, array('prototype' => $prototype));

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

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Prototype:build.html.'.$this->getEngine(), array(
            'form'      => $form->createView(),
            'product'   => $product,
            'prototype' => $prototype
        ));
    }

    /**
     * Lists all prototypes.
     *
     * @return Response
     */
    public function listAction(Request $request)
    {
        $prototypes = $this->container->get('sylius_assortment.manager.prototype')->findPrototypes();

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Prototype:list.html.'.$this->getEngine(), array(
            'prototypes'  => $prototypes
        ));
    }

    /**
     * Creates a new prototype.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $prototype = $this->container->get('sylius_assortment.manager.prototype')->createPrototype();
        $form = $this->container->get('form.factory')->create('sylius_assortment_prototype', $prototype);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PROTOTYPE_CREATE, new FilterPrototypeEvent($prototype));
                $this->container->get('sylius_assortment.manipulator.prototype')->create($prototype);
                $this->setFlash('success', 'sylius_assortment.flash.prototype.created');

                return $this->redirectToPrototypeList();
            }
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Prototype:create.html.'.$this->getEngine(), array(
            'form' => $form->createView()
        ));
    }

    /**
     * Updates a prototype.
     *
     * @param Request $request
     * @param integer $id      The prototype id
     *
     * @return Response
     */
    public function updateAction(Request $request, $id)
    {
        $prototype = $this->findPrototypeOr404($id);
        $form = $this->container->get('form.factory')->create('sylius_assortment_prototype', $prototype);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PROTOTYPE_UPDATE, new FilterPrototypeEvent($prototype));
                $this->container->get('sylius_assortment.manipulator.prototype')->update($prototype);
                $this->setFlash('success', 'sylius_assortment.flash.prototype.updated');

                return $this->redirectToPrototypeList();
            }
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Prototype:update.html.'.$this->getEngine(), array(
            'form'     => $form->createView(),
            'prototype' => $prototype
        ));
    }

    /**
     * Deletes prototype.
     *
     * @param integer $id The prototype id
     *
     * @return Response
     */
    public function deleteAction($id)
    {
        $prototype = $this->findPrototypeOr404($id);

        $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PROTOTYPE_DELETE, new FilterPrototypeEvent($prototype));
        $this->container->get('sylius_assortment.manipulator.prototype')->delete($prototype);
        $this->setFlash('success', 'sylius_assortment.flash.prototype.deleted');

        return $this->redirectToPrototypeList();
    }

    /**
     * Tries to find prototype with given id.
     * Throws a special http exception with code 404 if unsuccessful.
     *
     * @param integer $id The prototype id
     *
     * @return PrototypeInterface
     *
     * @throws NotFoundHttpException
     */
    protected function findPrototypeOr404($id)
    {
        if (!$prototype = $this->container->get('sylius_assortment.manager.prototype')->findPrototype($id)) {
            throw new NotFoundHttpException('Requested prototype does not exist');
        }

        return $prototype;
    }

    /**
     * Redirects to prototypes list.
     *
     * @return RedirectResponse
     */
    protected function redirectToPrototypeList()
    {
        return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_prototype_list'));
    }
}
