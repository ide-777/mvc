<?php

namespace controllers;

use core\Controller;
use modals\Directory;

class Index extends Controller
{
    public function __construct(int $pageId, string $privilegesPage)
    {
        parent::__construct($pageId, $privilegesPage);
    }

    public function action_index()
    {
        $this->checkPrivileges($this->privilegesPage);

        if ($this->view->setBaseTemplate([$this->templateBase])) {
            $this->view->setTitle(PAGE_MAIN_TITLE);
            $this->view->setDescription(PAGE_MAIN_DESCRIPTION);
            $this->view->setKeywords(PAGE_MAIN_KEYWORDS);

            $this->view->setVars([
                'date' => date('y-m-d'),
                'directory' => (new Directory())->readFolder(DR),
            ]);

            $this->view->setTemplateToZone('content','index');
            $this->view->open($this->pageId);

        }
    }
}