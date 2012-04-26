<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * Form event listener that sets product to created variation form dynamically based on
 * product data.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class BuildVariationTypeListener implements EventSubscriberInterface
{
    /**
     * Constructor.
     *
     * @param ProductInterface $product
     */
    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    /**
     * Sets product on variation.
     *
     * @param DataEvent $event
     */
    public function preSetData(DataEvent $event)
    {
        $variation = $event->getData();
        $form = $event->getForm();

        if (null === $variation) {
            return;
        }

        $variation->setProduct($this->product);
    }
}
