<?php

namespace controllers;

use core\Controller;

class About extends Controller
{
    public function __construct(int $pageId, string $privilegesPage)
    {
        parent::__construct($pageId, $privilegesPage);
    }

    public function action_index()
    {
        $this->checkPrivileges($this->privilegesPage);

        if ($this->view->setBaseTemplate([$this->templateBase])) {
            $this->view->setTitle(PAGE_ABOUT_TITLE);
            $this->view->setDescription(PAGE_ABOUT_DESCRIPTION);
            $this->view->setKeywords(PAGE_ABOUT_KEYWORDS);

            $this->view->setVars([
                'date' => date('y-m-d')
            ]);

            $this->view->setTemplateToZone('content','about');
            $this->view->open($this->pageId);

        }
    }
}