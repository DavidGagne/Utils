<?php

namespace Dws\Utils;

/**
 * Array utilities
 *
 * @author David Weinraub <david.weinraub@diamondwebservices.com>
 */
class Arrays
{
    /**
     * @see: http://www.php.net/manual/en/function.array-merge-recursive.php#92195
     * @param array $array1
     * @param array $array2
     * @return type
     */
    public static function merge_recursive_distinct ( array &$array1, array &$array2 )
    {
      $merged = $array1;

      foreach ( $array2 as $key => &$value )
      {
        if ( is_array ( $value ) && isset ( $merged [$key] ) && is_array ( $merged [$key] ) )
        {
          $merged [$key] = self::merge_recursive_distinct ( $merged [$key], $value );
        }
        else
        {
          $merged [$key] = $value;
        }
      }

      return $merged;
    }

    /**
     *
     * @param array $array
     * @param array $remove
     */
    public static function array_unset_recursive(&$array, $remove)
    {
        if (!is_array($remove)) {
            $remove = array($remove);
        }
        foreach ($array as $key => &$value) {
            if (in_array($value, $remove)) {
                unset($array[$key]);
            } else if (is_array($value)) {
                self::array_unset_recursive($value, $remove);
            }
        }
    }

    /**
     * Given: an array of keys ['key1', 'key2', ..., 'keyN'],
     * and a leaf value $leafValue, create an array $tree with:
     *
     * $tree ['key1']['key2']...['keyN'] = $leafValue
     *
     * @param array $tree
     * @param array $keys
     * @param mixed $leafValue
     * @return true
     */
    public static function setValueAsLeafViaPathKeys($pathKeys, $leafValue)
    {
        $return  = [];
        if (empty($pathKeys)) {
            return $leafValue;
        }
        $key = array_shift($pathKeys);
        $return[$key] = self::setValueAsLeafViaPathKeys($pathKeys, $leafValue);
        return $return;
    }

    static function deep_ksort(&$arr) {
        ksort($arr);
        foreach ($arr as &$a) {
            if (is_array($a) && !empty($a)) {
                self::deep_ksort($a);
            }
        }
    }

    /**
     * Shift a value off the given array using a key
     *
     * @param array $data
     * @return mixed|null
     */
    public static function shiftByKey(&$data, $key = '_id')
    {
        $key = (string) $key;

        if (isset($data[$key])) {
            $id = $data[$key];
            unset($data[$key]);
            return $id;
        } else {
            return null;
        }
    }

    /**
     * Shift a value off the gibven array using key _id
     * 
     * @param type $data
     * @return type
     */
    public static function shiftId(&$data)
    {
        return self::shiftByKey($data, '_id');
    }

    /**
     * Return a copy of an array minus those
     * provided by $except
     * 
     * @param $array array
     * @param $except mixed
     * @return array
     */
    public static function except($array, $except)
    {

        $rtnArray = array();

        if (!is_array($except)) {
            $except = array($except);
        }

        foreach ($array as $key => $value) {
            if (!in_array($key, $except)) {
                $rtnArray[$key] = $value;
            }
        }

        return $rtnArray;

    }

    public static function isAssociative($data)
    {
        
        if (!is_array($data)) {
            return false;
        }

        if (count($data) === 0) {
            return false;
        }

        return !is_numeric(implode("", array_keys($data)));

    }

    public static function isIndexed($data)
    {
        
        if (!is_array($data)) {
            return false;
        }

        if (count($data) === 0) {
            return false;
        }

        return is_numeric(implode("", array_keys($data)));
    
    }
    /**
    * update the key of an array which $data
    * if the key doesn't exist, create it with
    * the default data
    * @param $array the array who's key will be update
    * @param $key the key to be updated
    * @param $append if the data is any array, append data when true
    * @param $data the updated data
    * @param $default if the key doesn't exist exist it will be create with this value
    * 
    */
    public static function updateKey(&$array, $key, $data, $default=null, $append=false)
    {

        if (!array_key_exists($key, $array)) {
            $array[$key] = $default;
        }

        if (is_array($array[$key]) && $append) {
            
            if (!is_array($array[$key])) {
                throw new UtilsException("array key $key is not of type array");
            }
            
            $array[$key][] = $data;
        
        } else {
        
            $array[$key] = $data;    
        
        }

    }

    /**
     * Flatten a multi-dimensional associative array with dots.
     * based on from laravel's array_dot, but treats indexed arrays
     * as values so that they are not skipped
     *
     * @param  array   $array
     * @param  string  $prepend
     * @return array
     */
    public static function dot($array, $prepend = '')
    {
        $results = array();
        foreach ($array as $key => $value) {

            if (self::isAssociative($value)) {

                $results = array_merge($results, self::dot($value, $prepend.$key.'.'));
            }
            else {
                $results[$prepend.$key] = $value;
            }

        }

        return $results;
    }

    /**
    * take an indexed array of associative arrays
    * and point one keys value to another keys value
    */
    public static function associate(array $data, $key, $val, $indexed = true)
    {
        
        /*
        * first make sure we are dealing with an indexed array
        */
        if (!self::isIndexed($data))
            $data = array($data);

        /*
        * if an indexed array has been request
        */
        if ($indexed)
            return array_map(function($x) use ($key,$val) { return array($x[$key] => $x[$val]);}, $data);

        /*
        * if an associative array has been requested
        */
        $return = array();

        foreach ($data as $array) {
            $return[$array[$key]] = $array[$val];      
        }

        return $return;
    }


}