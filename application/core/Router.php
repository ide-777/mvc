<?php

namespace core;

class Router
{
    public function __construct()
    {
        $this->start();
    }

    private function start()
    {
        $site_path = empty($_GET['site_path']) ? "index" : $_GET['site_path'];
        $path = explode("/", rtrim($site_path, '/ '));

        if (!empty(Common::$_PAGES[$keyPage = strtolower('/' . implode('/', $path))])) {

            if (file_exists(DR . "/controllers/" . Common::$_PAGES[$keyPage]['controller'] . ".php")) {
                $controller = "controllers\\" . Common::$_PAGES[$keyPage]['controller'];

                $method = empty($_POST['act'])
                    ? 'action_' . Common::$_PAGES[$keyPage]['method']
                    : 'post_' . $_POST['act'];

                if (is_callable([$controller, $method])) {
                    (new $controller(Common::$_PAGES[$keyPage]['id'], Common::$_PAGES[$keyPage]['privileges']))->$method();
                } else {
                    $this->error404();
                }
            }
        } else {
            $this->error404();
        }
    }


    public static function error404()
    {
        self::redirect('/404');
    }

    public static function redirect(string $url)
    {
        header('location: '.$url);
        exit;
    }
}