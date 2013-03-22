<?php

namespace Dws\Utils;


/**
 * FileSystem utilities
 *
 * @author Juni Samos <jsamos@gmail.com>
 */
class FileSystem
{

    public static function listDirectory($dir, $filesOnly = false, $onlyTypes = array())
    {
        

        //@TODO add the onlyTypes support
        $filelist = array();
        $objects = glob($dir."*");
        

        foreach($objects as $name){

            if (!$filesOnly || is_file($name)) {
                $filelist[] = $name;
            }

        }

        return $filelist;

        
    }

    public static function listDirectoryRecursive($dir, $filesOnly = false, $onlyTypes = array())
    {

        //@TODO add the onlyTypes support
        $filelist = array();
        $objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir), \RecursiveIteratorIterator::SELF_FIRST);

        foreach($objects as $name => $object){
            
            if (!$filesOnly || is_file($name)) {
                $filelist[] = $name;
            }

        }

        return $filelist;

    }

}