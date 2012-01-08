<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Command;

use Sylius\Bundle\AssortmentBundle\EventDispatcher\Event\FilterProductEvent;
use Sylius\Bundle\AssortmentBundle\EventDispatcher\SyliusAssortmentEvents;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;

/**
 * Command for console that deletes product.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class DeleteProductCommand extends ContainerAwareCommand
{
    /**
     * @see Symfony\Component\Console\Command.Command::configure()
     */
    protected function configure()
    {
        $this
            ->setName('sylius:assortment:product:delete')
            ->setDescription('Deletes a product.')
            ->setDefinition(array(
                new InputArgument('id', InputArgument::REQUIRED, 'The product id'),
            ))
            ->setHelp(<<<EOT
The <info>sylius:assortment:product:delete</info> command deletes a product:

  <info>php sylius/console sylius:assortment:product:delete 24</info>
EOT
            );
    }

    /**
     * @see Symfony\Component\Console\Command.Command::execute()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $product = $this->getContainer()->get('sylius_assortment.manager.product')->findProduct($input->getArgument('id'));

        if (!$product) {
            throw new \InvalidArgumentException(sprintf('The product with id "%s" does not exist.', $input->getArgument('id')));
        }

        $this->getContainer()->get('event_dispatcher')->dispatch(SyliusAssortmentEvents::PRODUCT_DELETE, new FilterProductEvent($product));
        $this->getContainer()->get('sylius_assortment.manipulator.product')->delete($product);

        $output->writeln(sprintf('<info>[Sylius:Assortment]</info> Deleted product with id: <comment>%s</comment>', $input->getArgument('id')));
    }

    /**
     * @see Symfony\Component\Console\Command.Command::interact()
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('id')) {
            $id = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please insert product id: ',
                function($id = null)
                {
                    if (empty($id)) {
                        throw new \Exception('Product id must be specified.');
                    }
                    if (!is_numeric($id)) {
                        throw new \Exception('Product id must be integer.');
                    }
                    return $id;
                }
            );
            $input->setArgument('id', $id);
        }
    }
}
