<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Tests\Inflector;

use Sylius\Bundle\AssortmentBundle\Inflector\Slugizer;

class SlugizerTest extends \PHPUnit_Framework_TestCase
{
    public function testSlugize()
    {
        $slugizer = new Slugizer();
        $string = '#example String!!!,,,...';
        $slugizedString = 'example-string';
        $this->assertEquals($slugizer->slugize($string), $slugizedString);
        $string = 'example string          test';
        $slugizedString = 'example-string-test';
        $this->assertEquals($slugizer->slugize($string), $slugizedString);
    }
}
