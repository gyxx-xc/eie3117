<?php
require_once(dirname(__FILE__) . '/ServerError.class.php');
class View {
    private $viewName, $pageTitle, $viewVars, $tplName;

    function __construct($viewName, $pageTitle="", $tplName="default") {
        $this->viewName=$viewName;
        $this->pageTitle=$pageTitle;
        $this->viewVars=array();
        $this->tplName=$tplName;

        if(!is_file(dirname(__FILE__) . '/../views/' . $this->viewName . '.view.php')) {
            ServerError::throwError(500, 'Unable to load view: ' . $viewName);
        }

        if(!is_file(dirname(__FILE__) . '/../views/templates/' . $this->tplName . '.tpl.php')) {
            ServerError::throwError(500, 'Unable to load template: ' . $tplName);
        }
    }

    function render($vars = array()) {
        $currentView = $this;
        $pageTitle=$this->pageTitle;
        extract(array_merge($this->viewVars, $vars));
        include(dirname(__FILE__) . '/../views/templates/' . $this->tplName . '.tpl.php');
    }
    function addVar($varName, $varValue) {
        $this->viewVars[(string)$varName]=$varValue;
    }

    function showMainContent($vars=array()) {
        extract($vars);
        include(dirname(__FILE__) . '/../views/' . $this->viewName . '.view.php');
    }

    static function IncludeUIElements($type, $filenameWithoutExt, $deferredJS=FALSE) {
        $path = $type . '/' . $filenameWithoutExt . '.' . $type;
        if(is_file($path)) {
            if($type === "css") {
                echo '<link rel="stylesheet" href="/' . $path . '">';
            }else if($type === "js") {
                echo '<script src="/' . $path . '"' . ($deferredJS == TRUE ? ' defer' : '') . '></script>';
            }else{
                echo '';
            }
        }
    }

    function getViewName() {
        return $this->viewName;
    }
}
?>
