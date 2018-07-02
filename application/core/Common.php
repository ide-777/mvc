<?php

namespace core;

use Exception, Error;

class Common
{
    public static $_PAGES = [];
    public static $_PRIVILEGES;
    public static $db;
    public static $setting = [
        'defaultLang' => 'ru',
        'availableLang' => ['ru'],
    ];

    public function __construct()
    {
        self::$_PAGES = include_once DR . '/config/pages.php';
        self::$_PRIVILEGES = Privileges::instance();

        self::$_PRIVILEGES->setPrivileges('guest');

        try {

            self::$db = Db::instance()->getConnect();

        } catch (Exception $e) {

        } catch (Error $e) {

        }
    }

    public static function checkLang(string $lang): string
    {
        return false !== ($i = in_array(strtolower($lang), self::$setting['availableLang']))
            ? self::$setting['availableLang'][$i]
            : self::$setting['defaultLang'];
    }

    public static function checkAuth() {
        return !empty(Session::getSession()['auth']);
    }
}