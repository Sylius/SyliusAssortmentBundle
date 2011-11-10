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

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterProductEvent;
use Sylius\Bundle\AssortmentBundle\EventDispatcher\SyliusAssortmentEvents;

/**
 * Product backend controller.
 * 
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductController extends ContainerAware
{
    /**
     * Shows a product.
     */
    public function showAction($id)
    {
        $product = $this->container->get('sylius_assortment.manager.product')->findProduct($id);
        
        if (!$product) {
            throw new NotFoundHttpException('Requested product does not exist.');
        }
        
        return $this->container->get('templating')->renderResponse('SyliusAssortmentBundle:Backend/Product:show.html.' . $this->getEngine(), array(
        	'product' => $product
        ));
    }
    
    /**
     * List paginated products.
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
     * Creating a new product.
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
     * Updating a product.
     */
    public function updateAction($id)
    {
        $product = $this->container->get('sylius_assortment.manager.product')->findProduct($id);
        
        if (!$product) {
            throw new NotFoundHttpException('Requested product does not exist.');
        }
        
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
     */
    public function deleteAction($id)
    {
        $product = $this->container->get('sylius_assortment.manager.product')->findProduct($id);
        
        if (!$product) {
            throw new NotFoundHttpException('Requested product does not exist.');
        }
        
        $this->container->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PRODUCT_DELETE, new FilterProductEvent($product));
        $this->container->get('sylius_assortment.manipulator.product')->delete($product);
        
        return new RedirectResponse($this->container->get('request')->headers->get('referer'));
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
