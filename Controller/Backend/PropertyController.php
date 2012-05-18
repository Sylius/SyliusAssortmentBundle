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
use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterPropertyEvent;
use Sylius\Bundle\AssortmentBundle\EventDispatcher\SyliusAssortmentEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Product property backend controller.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PropertyController extends Controller
{
    /**
     * Lists all properties.
     *
     * @return Response
     */
    public function listAction(Request $request)
    {
        $properties = $this->container->get('sylius_assortment.manager.property')->findProperties();

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Property:list.html.'.$this->getEngine(), array(
            'properties'  => $properties
        ));
    }

    /**
     * Creates a new property.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $property = $this->container->get('sylius_assortment.manager.property')->createProperty();
        $form = $this->container->get('form.factory')->create('sylius_assortment_property', $property);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PROPERTY_CREATE, new FilterPropertyEvent($property));
                $this->container->get('sylius_assortment.manipulator.property')->create($property);
                $this->setFlash('success', 'sylius_assortment.flash.property.created');

                return $this->redirectoToPropertyList();
            }
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Property:create.html.'.$this->getEngine(), array(
            'form' => $form->createView()
        ));
    }

    /**
     * Updates a property.
     *
     * @param Request $request
     * @param integer $id The property id
     *
     * @return Response
     */
    public function updateAction(Request $request, $id)
    {
        $property = $this->findPropertyOr404($id);
        $form = $this->container->get('form.factory')->create('sylius_assortment_property', $property);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PROPERTY_UPDATE, new FilterPropertyEvent($property));
                $this->container->get('sylius_assortment.manipulator.property')->update($property);
                $this->setFlash('success', 'sylius_assortment.flash.property.updated');

                return $this->redirectoToPropertyList();
            }
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Property:update.html.'.$this->getEngine(), array(
            'form'     => $form->createView(),
            'property' => $property
        ));
    }

    /**
     * Deletes property.
     *
     * @param integer $id The property id
     *
     * @return Response
     */
    public function deleteAction($id)
    {
        $property = $this->findPropertyOr404($id);

        $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PROPERTY_DELETE, new FilterPropertyEvent($property));
        $this->container->get('sylius_assortment.manipulator.property')->delete($property);
        $this->setFlash('success', 'sylius_assortment.flash.property.deleted');

        return $this->redirectoToPropertyList();
    }

    /**
     * Tries to find property with given id.
     * Throws a special http exception with code 404 if unsuccessful.
     *
     * @param integer $id The property id
     *
     * @return PropertyInterface
     *
     * @throws NotFoundHttpException
     */
    protected function findPropertyOr404($id)
    {
        if (!$property = $this->container->get('sylius_assortment.manager.property')->findProperty($id)) {
            throw new NotFoundHttpException('Requested property does not exist');
        }

        return $property;
    }

    /**
     * Redirects to property list.
     *
     * @return RedirectResponse
     */
    protected function redirectoToPropertyList()
    {
        return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_property_list'));
    }
}
