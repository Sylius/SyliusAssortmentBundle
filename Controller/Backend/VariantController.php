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
use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterVariantEvent;
use Sylius\Bundle\AssortmentBundle\EventDispatcher\SyliusAssortmentEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Variant backend controller.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantController extends Controller
{
    /**
     * Shows a variant.
     *
     * @param integer $id The variant id
     *
     * @return Response
     */
    public function showAction($id)
    {
        $variant = $this->findVariantOr404($id);

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Variant:show.html.'.$this->getEngine(), array(
            'variant' => $variant
        ));
    }

    /**
     * Lists variant for given product.
     *
     * @param Request $request
     * @param mixed   $productId
     *
     * @return Response
     */
    public function listAction(Request $request, $productId)
    {
        if (!$product = $this->container->get('sylius_assortment.manager.product')->findProduct($productId)) {
            throw new NotFoundHttpException('Requested product does not exist');
        }

        $variants = $this->container->get('sylius_assortment.manager.variant')->findVariantsBy(array(
            'product' => $product,
            'master'  => false
        ));

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Variant:list.html.'.$this->getEngine(), array(
            'variants' => $variants,
            'product'  => $product
        ));
    }

    /**
     * Creates a new variant.
     *
     * @param Request $request
     * @param mixed   $productId
     *
     * @return Response
     */
    public function createAction(Request $request, $productId)
    {
        if (!$product = $this->container->get('sylius_assortment.manager.product')->findProduct($productId)) {
            throw new NotFoundHttpException('Requested product does not exist');
        }

        $variant = $this->container->get('sylius_assortment.manager.variant')->createVariant($product);
        $form = $this->container->get('form.factory')->create('sylius_assortment_variant', $variant);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::VARIANT_CREATE, new FilterVariantEvent($variant));
                $this->container->get('sylius_assortment.manipulator.variant')->create($variant);
                $this->setFlash('success', 'sylius_assortment.flash.variant.created');

                return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_variant_show', array(
                    'id' => $variant->getId()
                )));
            }
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Variant:create.html.'.$this->getEngine(), array(
            'form'    => $form->createView(),
            'product' => $product
        ));
    }

    /**
     * Updates a variant.
     *
     * @param Request $request
     * @param integer $id      The variant id
     *
     * @return Response
     */
    public function updateAction(Request $request, $id)
    {
        $variant = $this->findVariantOr404($id);
        $form = $this->container->get('form.factory')->create('sylius_assortment_variant', $variant);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::VARIANT_UPDATE, new FilterVariantEvent($variant));
                $this->container->get('sylius_assortment.manipulator.variant')->update($variant);
                $this->setFlash('success', 'sylius_assortment.flash.variant.updated');

                return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_variant_show', array(
                    'id' => $variant->getId()
                )));
            }
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Variant:update.html.'.$this->getEngine(), array(
            'form'    => $form->createView(),
            'variant' => $variant
        ));
    }

    /**
     * Deletes variants.
     *
     * @param integer $id The variant id
     *
     * @return Response
     */
    public function deleteAction($id)
    {
        $variant = $this->findVariantOr404($id);

        $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::VARIANT_DELETE, new FilterVariantEvent($variant));
        $this->container->get('sylius_assortment.manipulator.variant')->delete($variant);
        $this->setFlash('success', 'sylius_assortment.flash.variant.deleted');

        return new RedirectResponse($this->container->get('request')->headers->get('referer'));
    }

    /**
     * Tries to find variant with given id.
     * Throws a special http exception with code 404 if unsuccessful.
     *
     * @param integer $id The variant id
     *
     * @return VariantInterface
     *
     * @throws NotFoundHttpException
     */
    protected function findVariantOr404($id)
    {
        if (!$variant = $this->container->get('sylius_assortment.manager.variant')->findVariant($id)) {
            throw new NotFoundHttpException('Requested variant does not exist');
        }

        return $variant;
    }
}
