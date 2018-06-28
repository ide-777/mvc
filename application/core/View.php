<?php

namespace core;

class View
{
    private $title = '';
    private $description = '';
    private $keywords = '';
    private $_VARS = [];
    private $template = [];
    private $baseTemplate = [];
    private $tmplDir = __DIR__ . '/../views/';
    private $tmplDirBase = __DIR__ . '/../views/base/';

    public function __construct()
    {
        $this->title = DEFAULT_TITLE;
        $this->description = DEFAULT_TITLE;
        $this->keywords = DEFAULT_KEYWORDS;
    }

    public function setTitle(string $value)
    {
        $this->title = $value;
    }

    public function setDescription(string $value)
    {
        $this->description = $value;
    }

    public function setKeywords(string $value)
    {
        $this->keywords = $value;
    }

    public function setVars(array $_VARS)
    {
        $this->_VARS = $_VARS;
    }

    function setBaseTemplate(array $content): bool
    {
        if (!empty($content)) {
            foreach ($content as $k => $v) {
                $temp_content = $this->tmplDirBase . $v . ".php";
                if (file_exists($temp_content)) {
                    $this->baseTemplate[$k] = $temp_content;
                } else {
                    return false;
                }
            }
            return true;
        }
        return false;
    }


    public function setTemplateToZone(string $zone, string $template) :bool {
        if (file_exists($this->tmplDir  . $template. "_tmpl.php")) {
            $this->template[$zone] = $this->tmplDir  . $template. "_tmpl.php";
            return true;
        }
        return false;
    }


    public function getTemplateToZone(string $zone) {
        if (isset($this->template[$zone])) {
            $_VARS = $this->_VARS;
            include $this->template[$zone];
        }
    }

    public function open(int $pageId)
    {
            $pageTitle = $this->title;
            $pageDescription = $this->description;
            $pageKeywords = $this->keywords;

            $_VARS = $this->_VARS;
            $_PAGES = (function() {
                                    return array_filter(
                                        Common::$_PAGES,
                                        function ($value, $key)  {
                                            return $value['enabled'] == 1 && $value['show'] == 1;
                                        },
                                        ARRAY_FILTER_USE_BOTH
                                    );
                                })();

            foreach ($this->baseTemplate AS $t) {
                require_once $t;
            }
    }
}