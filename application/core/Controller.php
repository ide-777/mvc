<?php

namespace core;


abstract class Controller
{
    protected $view;
    protected $templateBase = 'base';
    protected $pageId;
    protected $privilegesPage;
    protected $rule = [];
    protected $_REQUEST_ARRAY = [];

    public function __construct(int $pageId, string $privilegesPage)
    {
        $this->view = new View();
        $this->pageId = $pageId;
        $this->privilegesPage = $privilegesPage;
    }

    protected function checkPrivilegesPost(string $name) : bool {

        return !empty($name) && Common::$_PRIVILEGES->checkPrivileges($name);
    }

    protected function checkPrivileges(string $name)
    {
        if(!empty($name) && !Common::$_PRIVILEGES->checkPrivileges($name)) {
            Router::error404();
        }
    }

    protected function checkRequest(string $method, array $pattern = [], array $check_data = [], $protocol = "POST"): bool
    {
        $pattern = empty($pattern) ? (!empty($this->rule[$method]) ? $this->rule[$method] : []) : $pattern;
//        $check_data = empty($check_data) ? ${'_' . strtoupper($protocol)} : $check_data;
        $check_data = empty($check_data) ? $_POST : $check_data;

//        var_dump($pattern);
        if(!empty($pattern) && !empty($check_data)) {
            foreach ($pattern AS $type => $value) {
                foreach ($value as $item) {
                    if (empty($check_data[$item]) && (empty($check_data['option']) || false === in_array($item, $check_data['option']))) {
                        echo 2;
                        var_dump(empty($check_data[$item]));
                        return false;
                    }
                    if ($type == 'array') {
                        if (false === $this->checkRequest($method, $pattern, $check_data)) {
                            return false;
                        }
                    } else if (is_callable(['Core\Pattern', 'pattern' . ucfirst($type)], true, $callable_name)) {

                        if (false === $callable_name($check_data[$item], $item)) {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }
            }
        } else {
            return false;
        }
        return true;
    }


    protected function answer(array $array) {
        die(json_encode($array));
    }
}