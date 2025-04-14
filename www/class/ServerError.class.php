<?php
require_once(dirname(__FILE__) . '/../class/View.class.php');

class ServerError {
    public static function throwError ($code, $reason) {
        http_response_code($code);
        $view = new View('error', 'Error');
        $view->addVar('code', $code);
        $view->addVar('reason', $reason);
        $view->render();
        exit();
    }
}
?>
