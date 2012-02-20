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
    /**
     * @dataProvider getStringsAndExpectedSlugs
     */
    public function testSlugize($expectedSlug, $string)
    {
        $slugizer = new Slugizer();
        $this->assertEquals($expectedSlug, $slugizer->slugize($string));
    }

    public function getStringsAndExpectedSlugs()
    {
        return array(
            array('foo-bar', 'foo bar'),
            array('foo-bar', 'FOO bAr'),
            array('foo-bar', 'foo    bar'),
            array('foo-bar', '   foo bar   '),
            array('foo-bar', '@!$#@foo @#$bar@!$@#')
        );
    }
}
