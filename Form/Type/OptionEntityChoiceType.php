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
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Option choice form type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class OptionEntityChoiceType extends OptionChoiceType
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'entity';
    }
}
