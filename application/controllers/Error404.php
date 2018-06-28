<?php

namespace controllers;

use core\Controller;

class Error404 extends Controller
{
    public function __construct(int $pageId, string $privilegesPage)
    {
        parent::__construct($pageId, $privilegesPage);
    }

    public function action_index()
    {
        if ($this->view->setBaseTemplate([$this->templateBase])) {
            $this->view->setTitle(PAGE_ERROR404_TITLE);
            $this->view->setDescription(PAGE_ERROR404_DESCRIPTION);
            $this->view->setKeywords(PAGE_ERROR404_KEYWORDS);


            $this->view->setTemplateToZone('content','error404');
            $this->view->open($this->pageId);
        }
    }
}