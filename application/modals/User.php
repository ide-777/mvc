<?php

namespace modals;

use core\{
    Common, Db, Modal, Session
};
use PDO, PDOException, Exception;

class User extends Modal
{

    private $authorizedTry = 3;
    private $authorizedTryTime = 3600;

    public function __construct()
    {
        parent::__construct(__CLASS__);
    }

    public function login($login, $password)
    {
        try {
            $st = $this->db->prepare("SELECT @id := u.id,  u.id, u.login, u.password, u.active,  u.try, u.tryTime, u.lang FROM users AS u WHERE login=:login");
            Db::autoBindValue($st, ['login' => $login]);
            $st->execute();
            if ($st->rowCount()) {
                $user = $st->fetch(PDO::FETCH_ASSOC);
                $user['try'] += 1;
                if ($user['active']) {
                    $pass = password_hash($password, PASSWORD_ARGON2I);
                    if (!($user['try'] >= $this->authorizedTry && $user['tryTime'] > $_SERVER['REQUEST_TIME'] - $this->authorizedTryTime)) {
                        if ($pass === $user['password']) {
//                            Session::setSession('userId', $user['id']);
//                            Session::setSession('lang', Common::checkLang($user['lang']));
//                            Session::setSession('auth', 1);
                            $st = $this->db->prepare("UPDATE users SET try = 0, tryTime = 0 WHERE id = @id");
                            $st->execute();
                            return true;
                        } else {
                            if ($user['try'] >= $this->authorizedTry) {
                                $st = $this->db->prepare("UPDATE users SET try = IF(try + 1 = 10, 10, try + 1) , tryTime = UNIX_TIMESTAMP() WHERE id = @id");
                                $st->execute();
                            }
                            throw new Exception('Error password', 4);

                        }
                    } else {
                        throw new Exception('User in time block', 3);
                    }
                } else {
                    throw new Exception('User not active', 2);
                }
            } else {
                throw new Exception('User not found', 1);
            }
        } catch (Exception $e) {
            $this->setLogs($e->getMessage(), (int)$e->getCode());
            return false;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }
}