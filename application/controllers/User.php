<?php

namespace controllers;


use core\Controller;
use modals\User as UserM;

class User extends Controller
{
    private $user;

    public function __construct(int $pageId, string $privilegesPage)
    {
        parent::__construct($pageId, $privilegesPage);
        $this->user = new UserM();

        $this->rule = [
            'auth' => [
                'string' => ['login', 'password'],
            ],
        ];
    }

    public function action_index()
    {
        $this->checkPrivileges($this->privilegesPage);

        if ($this->view->setBaseTemplate([$this->templateBase])) {
            $this->view->setTitle(PAGE_USER_TITLE);
            $this->view->setDescription(PAGE_USER_DESCRIPTION);
            $this->view->setKeywords(PAGE_USER_KEYWORDS);

            $this->view->setTemplateToZone('content', 'user');
            $this->view->open($this->pageId);
        }
    }

    public function post_auth()
    {
        if (!$this->checkPrivilegesPost($this->privilegesPage)) {
            $this->answer(['ok' => 0, 'error' => 'error_access']);
        }

        if (!$this->checkRequest('auth')) {
            $this->answer(['ok' => 0, 'error' => 'error_parameters']);
        }

        $this->answer($this->user->login($_POST['login'], $_POST['password'])
            ? ['ok' => 1]
            : ['ok' => 0, 'content' => ['error' => $this->user->getError()]]
        );
    }
}