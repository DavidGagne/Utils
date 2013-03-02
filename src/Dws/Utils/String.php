<?php

namespace Dws\Utils;

/**
 * 
 *
 * @author David Weinraub <david.weinraub@diamondwebservices.com>
 */
class String
{
    /**
     * Camelize a string. 
     * 
     * Examples: 
     * 
     * <code>
     * camelize('my-resource') == 'MyResource'
     * camelize('my-resource', true) == 'MyResource'
     * camelize('my-resource', false) == 'myResource'
     * </code>
     * 
     * @param string $string string to camelize
     * @param boolean $firstCharAsCap should we capitalize the first char. Default: true
     * @param string $sep separator on which split, default: '-'
     * @return type
     */
    public static function camelize($string, $firstCharAsCap = true, $sep = '-')
    {
        $arr = explode($sep, $string);
        array_walk($arr, function(&$element, $index) use ($firstCharAsCap) {
            // $element = strtolower($element);
            if (($index != 0) || $firstCharAsCap){
                $element = ucfirst($element);
            }
        });
        return implode('', $arr);
    }

    public static function unCamelize($string, $sep="")
    {
        $sub = substr($string,1);

        $capsCount = preg_match_all("/[A-Z]/",$sub, $matches);

        if (!$capsCount) {

            return $string;

        } else {

            $caps = $matches[0];
            $seperated = array_map(function($x) use($sep) {
                return $sep . $x;
            },$caps);
            $sub = str_replace($caps, $seperated, $sub);

            return strtolower($string[0] . $sub);

        }
    }

}
