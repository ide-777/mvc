<?php

namespace core;

class Session
{
    public static function startSession($sessionLifeTimeSecond = 3600)
    {
        try {
            if (empty(session_id())) {

                ini_set('session.cookie_lifetime', $sessionLifeTimeSecond);

                if ($sessionLifeTimeSecond) {
                    ini_set('session.gc_maxlifetime', $sessionLifeTimeSecond);
                }
                if (session_start()) {
                    setcookie(session_name(), session_id(), time() + $sessionLifeTimeSecond);
                } else {
                    throw new \Exception('Error start session');
                }
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public static function getSession()
    {
        return $_SESSION;
    }

    public static function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function destroySession()
    {
        if (session_id()) {
            session_unset();
            setcookie(session_name(), session_id(), time() - 60 * 60 * 24);
            session_destroy();
        }
    }
}