<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.06.2018
 * Time: 14:56
 */

namespace core;


class Modal extends Logs
{
    protected $db;

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->db = Common::$db;
    }
}