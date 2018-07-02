<?php

ini_set('error_reporting', E_ALL);
ini_set("display_startup_errors",1);
ini_set('display_errors', 1);

define('DR', __DIR__.'/application');

require_once DR.'/dictionary/ru.php';

class Autoloader
{
    private static $_separator_class = '\\';
    private static $_last_loaded_file;
    private static $dr = DR.'/';

    //new version (согласно PSR-1)
    public static function loadPackages($className)
    {
        $pathParts = explode(self::$_separator_class, $className);

        self::$_last_loaded_file = self::$dr . implode(DIRECTORY_SEPARATOR, $pathParts) . '.php';
        if (file_exists(self::$_last_loaded_file)) {
            require_once(self::$_last_loaded_file);
        } else {
            return false;
        }
    }
}

spl_autoload_register(['Autoloader', 'loadPackages'],true);

\core\Session::startSession();

new \core\Common();
new \core\Router();