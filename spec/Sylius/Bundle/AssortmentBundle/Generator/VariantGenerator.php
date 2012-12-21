<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Generator;

use PHPSpec2\ObjectBehavior;

/**
 * Variant generator spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class VariantGenerator extends ObjectBehavior
{
    /**
     * @param Symfony\Component\Validator\ValidatorInterface $validator
     * @param Doctrine\Common\Persistence\ObjectRepository   $variantRepository
     */
    function let($validator, $variantRepository)
    {
        $this->beConstructedWith($validator, $variantRepository);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Generator\VariantGenerator');
    }

    function it_should_be_a_Sylius_variant_generator()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Generator\VariantGeneratorInterface');
    }
}
