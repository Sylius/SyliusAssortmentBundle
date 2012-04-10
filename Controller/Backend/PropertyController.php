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

use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterPropertyEvent;
use Sylius\Bundle\AssortmentBundle\EventDispatcher\SyliusAssortmentEvents;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Product property backend controller.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PropertyController extends ContainerAware
{
    /**
     * Lists all properties.
     *
     * @return Reponse
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
     * @return Reponse
     */
    public function createAction(Request $request)
    {
        $property = $this->container->get('sylius_assortment.manager.property')->createProperty();

        $form = $this->container->get('form.factory')->create('sylius_assortment_property');
        $form->setData($property);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PROPERTY_CREATE, new FilterPropertyEvent($property));
                $this->container->get('sylius_assortment.manipulator.property')->create($property);

                return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_property_show', array(
                    'id' => $property->getId()
                )));
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
     * @param integer $id      The property id
     *
     * @return Response
     */
    public function updateAction(Request $request, $id)
    {
        $property = $this->findPropertyOr404($id);

        $form = $this->container->get('form.factory')->create('sylius_assortment_property');
        $form->setData($property);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PROPERTY_UPDATE, new FilterPropertyEvent($property));
                $this->container->get('sylius_assortment.manipulator.property')->update($property);

                return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_property_show', array(
                    'id' => $property->getId()
                )));
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

        return new RedirectResponse($this->container->get('request')->headers->get('referer'));
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
     * Returns templating engine name.
     *
     * @return string
     */
    protected function getEngine()
    {
        return $this->container->getParameter('sylius_assortment.engine');
    }
}
