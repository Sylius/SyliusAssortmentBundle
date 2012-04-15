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

use Sylius\Bundle\AssortmentBundle\Form\ChoiceList\VariantChoiceList;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;
use Sylius\Bundle\AssortmentBundle\SyliusAssortmentBundle;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\FormException;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Options;

/**
 * Variant choice form type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantChoiceType extends AbstractType
{
    /**
     * Bundle driver.
     *
     * @var string
     */
    protected $driver;

    /**
     * Constructor.
     *
     * @param string $driver The bundle driver
     */
    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        if (!isset($options['product']) || !$options['product'] instanceof ProductInterface) {
            throw new FormException('You have to pass "Sylius\Bundle\AssortmentBundle\Model\ProductInterface" as "product" option to variant choice type');
        }

        $doctrineBasedDrivers = array(
            SyliusAssortmentBundle::DRIVER_DOCTRINE_ORM,
            SyliusAssortmentBundle::DRIVER_DOCTRINE_MONGODB_ODM,
            SyliusAssortmentBundle::DRIVER_DOCTRINE_COUCHDB_ODM
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
        $choiceList = function (Options $options) {
            return new VariantChoiceList($options['product']);
        };

        return array(
            'product'     => null,
            'choice_list' => $choiceList
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
        return 'sylius_assortment_variant_choice';
    }
}
