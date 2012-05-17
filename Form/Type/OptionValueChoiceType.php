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

use Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\FormException;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\Options;

/**
 * Option value choice form type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class OptionValueChoiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        if (!isset($options['option']) || !$options['option'] instanceof OptionInterface) {
            throw new FormException('The "option" must be instance of "Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface"');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        $choiceList = function (Options $options) {
            return new ObjectChoiceList($options['option']->getValues(), 'value', array(), null, null, 'id');
        };

        return array(
            'option'      => null,
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
        return 'sylius_assortment_option_value_choice';
    }
}
