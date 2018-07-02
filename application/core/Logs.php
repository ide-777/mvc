<?php

namespace core;


class Logs
{
    private $logs = [];
    private $key = 'empty';

    private $_ERROR = [
        0 => ['message' => 'неизвестная ошибка'],
        1 => ['message' => 'неверный пользователь или пароль'],
        2 => ['message' => 'пользователь не активирован'],
        3 => ['message' => 'пользователь временно блокирован'],
        4 => ['message' => 'неверный пользователь или пароль'],

        1001 => ['message' => 'ошибка PDO'],
    ];

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function setLogs(string $errorMessage, int $errorCode = 0)
    {
        $this->logs[$this->key][] = [
            'message' => $errorMessage,
            'code' => $errorCode,
        ];
    }

    public function setLogsPDO(string $errorMessage, int $errorCode = 0)
    {
        $this->logs[$this->key][] = [
            'message' => $errorMessage,
            'code' => $errorCode,
        ];
    }

    public function getError(): array
    {
        return (function () {
            $_a = [];
            foreach ($this->logs[$this->key] AS $value) {
                $_a[] = !empty($this->_ERROR[$value['code']]) ? $this->_ERROR[$value['code']] : $this->_ERROR[0];
            }
            return $_a;
        })();
    }
}