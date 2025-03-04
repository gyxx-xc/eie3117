<?php
require("class/ServerError.class.php");
require("vendor/autoload.php");

$router = new AltoRouter();
$router->setBasePath("");

// Route definitions
$router->map('GET', '/event', 'EventController@showEventDetail');
$router->map('GET', '/create', 'EventController@showCreateEvent');
$match = $router->match();

if(!$match) { // No match, which means the user is browsing a non-defined page
    ServerError::throwError(404, 'Path not found');
}else{
    // Test the syntax: "controller_name@function"
    list($controllerClassName, $methodName) = explode('@', $match['target']);
    if((@include_once("controllers/" . $controllerClassName . ".class.php")) == TRUE) {
        if (is_callable(array($controllerClassName, $methodName))) {
            call_user_func_array(array($controllerClassName, $methodName), ($match['params']));
        } else {
            ServerError::throwError(500, 'Route not callable');
        }
    }else{
        ServerError::throwError(500, 'Controller not includible');
    }
}
?>
