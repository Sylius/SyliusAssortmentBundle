<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Form\Type;

use Sylius\Bundle\AssortmentBundle\Form\ChoiceList\PropertyChoiceList;
use Sylius\Bundle\AssortmentBundle\SyliusAssortmentBundle;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Property choice form type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PropertyChoiceType extends AbstractType
{
    /**
     * Bundle driver.
     *
     * @var string
     */
    protected $driver;

    /**
     * Property choice list.
     *
     * @var PropertyChoiceList
     */
    protected $propertyChoiceList;

    /**
     * Constructor.
     *
     * @param string           $driver               The bundle driver
     * @param PropertyChoiceList $propertyChoiceList Choice list with all properties
     */
    public function __construct($driver, PropertyChoiceList $propertyChoiceList)
    {
        $this->driver = $driver;
        $this->propertyChoiceList = $propertyChoiceList;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $doctrineBasedDrivers = array(
            SyliusAssortmentBundle::DRIVER_DOCTRINE_ORM,
        );

        if ($options['multiple'] && in_array($this->driver, $doctrineBasedDrivers)) {
            $builder->prependClientTransformer(new CollectionToArrayTransformer());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'choice_list' => $this->propertyChoiceList
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_assortment_property_choice';
    }
}
