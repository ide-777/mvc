<?php

namespace core;


class Common
{
    public static $_PAGES = [];
    public static $_PRIVILEGES;

    public function __construct()
    {
        self::$_PAGES = include_once DR.'/config/pages.php';
        self::$_PRIVILEGES = Privileges::instance();

        self::$_PRIVILEGES->setPrivileges('guest');
    }
}