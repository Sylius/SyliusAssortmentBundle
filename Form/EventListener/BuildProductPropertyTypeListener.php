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
 * Form event listener that builds product form dynamically based on product data.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class BuildProductPropertyTypeListener implements EventSubscriberInterface
{
    /**
     * Form factory.
     *
     * @var FormFactoryInterface
     */
    private $factory;

    /**
     * Constructor.
     *
     * @param FormFactoryInterface $factory
     */
    public function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    /**
     * Builds proper product form after setting the product.
     *
     * @param DataEvent $event
     */
    public function preSetData(DataEvent $event)
    {
        $productProperty = $event->getData();
        $form = $event->getForm();

        if (null === $productProperty) {
            return;
        }

        $form
            ->remove('property')
            ->remove('value')
            ->add($this->factory->createNamed('text', 'value', null, array('label' => $productProperty->getName())))
        ;
    }
}
