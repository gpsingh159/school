<?php
class Autoload
{
    public static function load()
    {
        spl_autoload_register(function ($class) {
            $newClass = str_replace('\\', DIRECTORY_SEPARATOR, $class);
            $basePath = realpath(__DIR__) . DIRECTORY_SEPARATOR;
            $file = $basePath . $newClass . ".php";

            include_once $file;
        });
    }
}
