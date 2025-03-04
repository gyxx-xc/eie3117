<?php
require("class/ServerError.class.php");
require("vendor/autoload.php");

$router = new AltoRouter();
$router->setBasePath("");

$router->map('GET', '/event/[i:event_id]?', 'EventController@showEventDetail');
$router->map('GET', '/create_event', 'EventController@showCreateEvent');
$router->map('POST', '/create_event', 'EventController@processCreateEvent');

$match = $router->match();
if(!$match)
    ServerError::throwError(404, 'Path not found');

list($controllerClassName, $methodName) = explode('@', $match['target']);
if(!@include_once("controllers/" . $controllerClassName . ".class.php"))
    ServerError::throwError(500, 'Controller not includible');
if (!is_callable(array($controllerClassName, $methodName)))
    ServerError::throwError(500, 'Route not callable');

call_user_func_array(array($controllerClassName, $methodName), ($match['params']));
?>
