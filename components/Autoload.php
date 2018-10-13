<?php
/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 09-Sep-16
 * Time: 1:09 PM
 */

function __autoload($class_name)
{
    # List all the class directories in the array
    $array_pathes = array(
        '/models/',
        '/components/'
    );

    foreach ($array_pathes as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}