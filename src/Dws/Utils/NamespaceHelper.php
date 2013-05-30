<?php namespace Dws\Utils;

class NamespaceHelper {

    public static function extend($base, $extension)
    {
        return (substr($base, -1) != "\\") ? $base . "\\" . $extension : $base . $extension;
    }

    public static function shortName($class)
    {
        $class = explode('\\', $class);
        return end($class);
    }

    public static function classNamespace($class) {
        $class = explode('\\', $class);
        return  join('\\', array_slice($class, 0, -1));
    }

}