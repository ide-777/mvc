<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 27.06.2018
 * Time: 15:05
 */

namespace core;


class Privileges
{
    private static $inst;
    private $privileges = [];
    public $NON = 'NON';

    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function instance(): Privileges
    {
        if (empty(self::$inst)) {
            self::$inst = new self();
        }
        return self::$inst;
    }

    public function setPrivileges(string $name): bool
    {
        $prv = include DR . '/config/privileges.php';
        $this->privileges = !empty($prv[$name]) ? $prv[$name] : [];

        return !empty($this->privileges);
    }

    public function checkPrivileges(string $name): bool
    {
        return false !== in_array( $name, $this->privileges);
    }
}