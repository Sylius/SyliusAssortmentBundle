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

use Sylius\Bundle\AssortmentBundle\Form\ChoiceList\OptionChoiceList;
use Sylius\Bundle\AssortmentBundle\SyliusAssortmentBundle;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Option choice form type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class OptionChoiceType extends AbstractType
{
    /**
     * Bundle driver.
     *
     * @var string
     */
    protected $driver;

    /**
     * Option choice list.
     *
     * @var OptionChoiceList
     */
    protected $optionChoiceList;

    /**
     * Constructor.
     *
     * @param string           $driver           The bundle driver
     * @param OptionChoiceList $optionChoiceList Choice list with all options
     */
    public function __construct($driver, OptionChoiceList $optionChoiceList)
    {
        $this->driver = $driver;
        $this->optionChoiceList = $optionChoiceList;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
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
    public function getDefaultOptions()
    {
        return array(
            'choice_list' => $this->optionChoiceList,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(array $options)
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_assortment_option_choice';
    }
}
