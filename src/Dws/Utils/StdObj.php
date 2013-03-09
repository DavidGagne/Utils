<?php

namespace Dws\Utils;

use Dws\Utils\Arrays;

/**
 * StdObj utilities
 *
 * @author David Weinraub <david.weinraub@diamondwebservices.com>
 */
class StdObj
{
    public static function setAttributes($attribs, $obj = null) 
    {

        if (!Arrays::isAssociative($attribs)) {
            throw new UtilsException("StdObj setAttributes Argument 0 must be an associative array");
        }

        $obj = ($obj) ? $obj : new \stdClass;

        foreach ($attribs as $k => $v) {
            $obj->$k = $v;    
        }

        return $obj;

    }

}