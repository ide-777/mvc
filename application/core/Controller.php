<?php

namespace core;


abstract class Controller
{
    protected $view;
    protected $templateBase = 'base';
    protected $pageId;
    protected $privilegesPage;

    public function __construct(int $pageId, string $privilegesPage)
    {
        $this->view = new View();
        $this->pageId = $pageId;
        $this->privilegesPage = $privilegesPage;
    }

    public function checkPrivileges(string $name)
    {
        if(!empty($name) && !Common::$_PRIVILEGES->checkPrivileges($name)) {
            Router::error404();
        }
    }
}