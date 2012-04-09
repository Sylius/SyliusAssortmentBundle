<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AssortmentBundle\Twig;

use Twig_Extension;
use Twig_Function_Method;

/**
 * Assortment extension for twig templating engine.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class SyliusAssortmentExtension extends Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'sylius_assortment_cut_text'         => new Twig_Function_Method($this, 'cutText', array('is_safe' => array('html'))),
        );
    }

   /**
     * Cuts the text.
     */
    public function cutText($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false)
    {
        if ($considerHtml) {

            if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }

            preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

            $totalLength = strlen($ending);
            $openTags = array();
            $truncate = '';

            foreach ($lines as $lineMatchings) {

                if (!empty($lineMatchings[1])) {

                    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $lineMatchings[1])) {

                    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $lineMatchings[1], $tagMatchings)) {

                        $pos = array_search($tagMatchings[1], $openTags);
                        if ($pos !== false) {
                            unset($openTags[$pos]);
                        }

                    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $lineMatchings[1], $tagMatchings)) {

                        array_unshift($openTags, strtolower($tagMatchings[1]));
                    }

                    $truncate .= $lineMatchings[1];
                }


                $contentLength = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $lineMatchings[2]));
                if ($totalLength + $contentLength> $length) {

                    $left = $length - $totalLength;
                    $entitiesLength = 0;

                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $lineMatchings[2], $entities, PREG_OFFSET_CAPTURE)) {

                        foreach ($entities[0] as $entity) {
                            if ($entity[1]+1-$entitiesLength <= $left) {
                                $left--;
                                $entitiesLength += strlen($entity[0]);
                            } else {
                                break;
                            }
                        }
                    }
                    $truncate .= substr($lineMatchings[2], 0, $left+$entitiesLength);

                    break;
                } else {
                    $truncate .= $lineMatchings[2];
                    $totalLength += $contentLength;
                }

                if($totalLength>= $length) {
                    break;
                }
            }
        } else {
            if (strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = substr($text, 0, $length - strlen($ending));
            }
        }

        if (!$exact) {
            $spacepos = strrpos($truncate, ' ');

            if (isset($spacepos)) {
                $truncate = substr($truncate, 0, $spacepos);
            }
        }

        $truncate .= $ending;

        if($considerHtml) {
            foreach ($openTags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }

        return $truncate;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'sylius_assortment';
    }
}
