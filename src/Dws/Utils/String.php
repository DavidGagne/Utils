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
    /**
     * un-camelize a string. 
     * 
     * Examples: 
     * 
     * <code>
     * unCamelize('MyResource') == 'my-resource'
     * </code>
     * 
     * @param string $string string to un-camelize
     * @param string $sep separator on which split, default: ''
     * @return type
     */
    public static function unCamelize($string, $sep="")
    {

        $sub = substr($string,1);
        $pattern = '/[A-Z]/';
        $replacement = $sep . '${0}';
        $seperated = preg_replace($pattern, $replacement, $sub);
        return strtolower($string[0] . $seperated);

    }

}