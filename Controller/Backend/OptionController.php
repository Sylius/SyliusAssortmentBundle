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

use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterOptionEvent;
use Sylius\Bundle\AssortmentBundle\EventDispatcher\SyliusAssortmentEvents;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Product option backend controller.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class OptionController extends ContainerAware
{
    /**
     * Lists all options.
     *
     * @return Reponse
     */
    public function listAction(Request $request)
    {
        $options = $this->container->get('sylius_assortment.manager.option')->findOptions();

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Option:list.html.'.$this->getEngine(), array(
            'options'  => $options
        ));
    }

    /**
     * Creates a new option.
     *
     * @param Request $request
     *
     * @return Reponse
     */
    public function createAction(Request $request)
    {
        $option = $this->container->get('sylius_assortment.manager.option')->createOption();

        $form = $this->container->get('form.factory')->create('sylius_assortment_option');
        $form->setData($option);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::OPTION_CREATE, new FilterOptionEvent($option));
                $this->container->get('sylius_assortment.manipulator.option')->create($option);

                return $this->redirectToOptionList();
            }
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Option:create.html.'.$this->getEngine(), array(
            'form' => $form->createView()
        ));
    }

    /**
     * Updates a option.
     *
     * @param Request $request
     * @param integer $id      The option id
     *
     * @return Response
     */
    public function updateAction(Request $request, $id)
    {
        $option = $this->findOptionOr404($id);

        $form = $this->container->get('form.factory')->create('sylius_assortment_option');
        $form->setData($option);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::OPTION_UPDATE, new FilterOptionEvent($option));
                $this->container->get('sylius_assortment.manipulator.option')->update($option);

                return $this->redirectToOptionList();
            }
        }

        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Option:update.html.'.$this->getEngine(), array(
            'form'     => $form->createView(),
            'option' => $option
        ));
    }

    /**
     * Deletes option.
     *
     * @param integer $id The option id
     *
     * @return Response
     */
    public function deleteAction($id)
    {
        $option = $this->findOptionOr404($id);

        $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::OPTION_DELETE, new FilterOptionEvent($option));
        $this->container->get('sylius_assortment.manipulator.option')->delete($option);

        return $this->redirectToOptionList();
    }

    /**
     * Tries to find option with given id.
     * Throws a special http exception with code 404 if unsuccessful.
     *
     * @param integer $id The option id
     *
     * @return OptionInterface
     *
     * @throws NotFoundHttpException
     */
    protected function findOptionOr404($id)
    {
        if (!$option = $this->container->get('sylius_assortment.manager.option')->findOption($id)) {
            throw new NotFoundHttpException('Requested option does not exist');
        }

        return $option;
    }

    /**
     * Redirects to option list.
     *
     * @return RedirectResponse
     */
    protected function redirectToOptionList()
    {
        return new RedirectResponse($this->container->get('router')->generate('sylius_assortment_backend_option_list'));
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

