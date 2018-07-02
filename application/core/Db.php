<?php

namespace core;

use PDO, PDOStatement, PDOException;

class Db
{

    private static $inst;
    private $db;

    private function __construct()
    {
        $config = include DR . '/config/db.php';
        try {
            $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['name'] . '', $config['user'], $config['password'],
                [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '" . $config['enc'] . "'"]);

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Error connect db");
        }
}

    public static function instance(): Db
    {
        if (empty(self::$inst)) {
            self::$inst = new self();
        }
        return self::$inst;
    }

    public function getConnect() : PDO {
        return $this->db;
    }

    public static function autoBindValue(PDOStatement $st, array $params = []) : bool
    {
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $st->bindValue(':' . $key, $val, $type);
            }
            return true;
        }
        return false;
    }
}