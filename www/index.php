<?php
require("class/ServerError.class.php");
require("class/SessionController.class.php");
require("vendor/autoload.php");

SessionController::getInstance();

$router = new AltoRouter();
$router->setBasePath("");

$router->map('GET', '/event/[i:event_id]', 'EventController@showEventDetail');
$router->map('GET', '/create_event', 'EventController@showCreateEvent');
$router->map('POST', '/create_event', 'EventController@processCreateEvent');

$router->map("GET", '/user_event/[i:page]', 'ListController@showUserCreateList');
$router->map("GET", '/joined_event/[i:page]', 'ListController@showUserJoinList');
$router->map("GET", '/all_event/[i:page]', 'ListController@showAllList');
$router->map("GET", '/join_event/[i:event_id]', 'ListController@processJoinEvent');
$router->map('GET', '/', 'ListController@showMain');

$router->map('GET', '/logout', 'LoginController@logout');
$router->map('GET', '/login', 'LoginController@showLogin');
$router->map('POST', '/login', 'LoginController@processLogin');
$router->map('GET', '/register', 'LoginController@showRegister');
$router->map('POST', '/register', 'LoginController@processRegister');
$router->map('GET', '/upload', 'LoginController@showUpload');
$router->map('POST', '/upload', 'LoginController@processUpload');

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
