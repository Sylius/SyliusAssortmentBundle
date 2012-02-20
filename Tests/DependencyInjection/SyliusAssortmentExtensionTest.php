<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Sylius\Bundle\AssortmentBundle\DependencyInjection\SyliusAssortmentExtension;
use Symfony\Component\Yaml\Parser;

class SyliusAssortmentExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testUserLoadThrowsExceptionUnlessDriverSet()
    {
        $extension = new SyliusAssortmentExtension();
        $config = $this->getEmptyConfig();
        unset($config['driver']);
        $extension->load(array($config), new ContainerBuilder());
    }

    /**
    * @expectedException \InvalidArgumentException
    */
    public function testLoadThrowsExceptionUnlessDriverIsValid()
    {
        $extension = new SyliusAssortmentExtension();
        $config = $this->getEmptyConfig();
        $config['driver'] = 'foo';
        $extension->load(array($config), new ContainerBuilder());
    }

    /**
    * @expectedException \InvalidArgumentException
    */
    public function testLoadThrowsExceptionUnlessEngineIsValid()
    {
        $extension = new SyliusAssortmentExtension();
        $config = $this->getEmptyConfig();
        $config['engine'] = 'foo';
        $extension->load(array($config), new ContainerBuilder());
    }

    /**
    * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
    */
    public function testLoadThrowsExceptionUnlessProductModelClassSet()
    {
        $extension = new SyliusAssortmentExtension();
        $config = $this->getEmptyConfig();
        unset($config['classes']['model']['product']);
        $extension->load(array($config), new ContainerBuilder());
    }

    /**
     * @return array
     */
    protected function getEmptyConfig()
    {
        $yaml = <<<EOF
driver: ORM
classes:
    model:
        product: Sylius\Bundle\AssortmentBundle\Entity\DefaultProduct
EOF;

        $parser = new Parser();

        return $parser->parse($yaml);
    }
}
