<?php

namespace spec\Sylius\Bundle\AssortmentBundle\Model\Variant;

use PHPSpec2\ObjectBehavior;

/**
 * Product variant (variation) spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Variant extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssortmentBundle\Model\Variant\Variant');
    }

    function it_should_be_a_Sylius_product_variant()
    {
        $this->shouldImplement('Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_should_not_belong_to_a_product_by_default()
    {
        $this->getProduct()->shouldReturn(null);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface $product
     */
    function it_should_allow_assigning_itself_to_a_product($product)
    {
        $this->setProduct($product);
        $this->getProduct()->shouldReturn($product);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface $product
     */
    function it_should_allow_detaching_itself_from_a_product($product)
    {
        $this->setProduct($product);
        $this->getProduct()->shouldReturn($product);

        $this->setProduct(null);
        $this->getProduct()->shouldReturn(null);
    }

    function it_should_not_be_master_variant_by_default()
    {
        $this->shouldNotBeMaster();
    }

    function it_should_be_master_variant_when_marked_so()
    {
        $this->shouldNotBeMaster();

        $this->setMaster(true);

        $this->shouldBeMaster();
    }

    function it_should_not_have_presentation_by_default()
    {
        $this->getPresentation()->shouldReturn(null);
    }

    function its_presentation_should_be_mutable()
    {
        $this->setPresentation('Super variant');
        $this->getPresentation()->shouldReturn('Super variant');
    }

    function it_should_initialize_option_values_collection_by_default()
    {
        $this->getOptions()->shouldHaveType('Doctrine\Common\Collections\Collection');
    }

    /**
     * @param Doctrine\Common\Collections\Collection $options
     */
    function its_option_values_collection_should_be_mutable($options)
    {
        $this->setOptions($options);
        $this->getOptions()->shouldReturn($options);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface $option
     */
    function it_should_add_option_value_properly($option)
    {
        $this->addOption($option);
        $this->hasOption($option)->shouldReturn(true);
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface $option
     */
    function it_should_remove_option_value_properly($option)
    {
        $this->addOption($option);
        $this->hasOption($option)->shouldReturn(true);

        $this->removeOption($option);
        $this->hasOption($option)->shouldReturn(false);
    }

    function it_should_initialize_availability_date_by_default()
    {
        $this->getAvailableOn()->shouldHaveType('DateTime');
    }

    function it_should_be_available_by_default()
    {
        $this->shouldBeAvailable();
    }

    function its_availability_date_should_be_mutable()
    {
        $availableOn = new \DateTime('yesterday');

        $this->setAvailableOn($availableOn);
        $this->getAvailableOn()->shouldReturn($availableOn);
    }

    function it_should_be_available_only_if_availability_date_is_in_past()
    {
        $availableOn = new \DateTime('yesterday');

        $this->setAvailableOn($availableOn);
        $this->shouldBeAvailable();

        $availableOn = new \DateTime('tomorrow');

        $this->setAvailableOn($availableOn);
        $this->shouldNotBeAvailable();
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface $masterVariant
     */
    function it_should_complain_if_trying_to_inherit_values_and_being_a_master_variant($masterVariant)
    {
        $this->setMaster(true);

        $this
            ->shouldThrow('LogicException')
            ->duringInherit($masterVariant)
        ;
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface $variant
     */
    function it_should_complain_if_trying_to_inherit_values_from_non_master_variant($variant)
    {
        $variant->isMaster()->willReturn(false);

        $this
            ->shouldThrow('InvalidArgumentException')
            ->duringInherit($variant)
        ;
    }

    /**
     * @param Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface $masterVariant
     */
    function it_should_inherit_availability_time_from_master_variant($masterVariant)
    {
        $availableOn = new \DateTime('tomorrow');

        $masterVariant->isMaster()->willReturn(true);
        $masterVariant->getAvailableOn()->willReturn($availableOn);

        $this->inherit($masterVariant);

        $this->getAvailableOn()->shouldReturn($availableOn);
    }

    function it_should_initialize_creation_date_by_default()
    {
        $this->getCreatedAt()->shouldHaveType('DateTime');
    }

    function it_should_not_have_last_update_date_by_default()
    {
        $this->getUpdatedAt()->shouldReturn(null);
    }

    function it_should_not_have_deletion_date_by_default()
    {
        $this->getDeletedAt()->shouldReturn(null);
    }

    function its_deletion_date_should_be_mutable()
    {
        $deletedAt = new \DateTime('now');

        $this->setDeletedAt($deletedAt);
        $this->getDeletedAt()->shouldReturn($deletedAt);
    }

    function it_should_be_deleted_only_if_deletion_date_is_in_past()
    {
        $deletedAt = new \DateTime('yesterday');

        $this->setDeletedAt($deletedAt);
        $this->shouldBeDeleted();

        $deletedAt = new \DateTime('tomorrow');

        $this->setDeletedAt($deletedAt);
        $this->shouldNotBeDeleted();
    }

    function it_should_not_be_deleted_by_default()
    {
        $this->shouldNotBeDeleted();
    }
}
