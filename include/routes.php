<?php
/**
 * Routing Table
 *
 * These rules are used by the Dispatcher to map from a URL to a controller,
 * action (function on the controller), and any additional parameters which
 * will be passed to the controller's action.  All loaded plugins will have
 * their routing rules automatically merged with the ones listed below.
 *
 * Updated 2015-07-18 to use Aura Router
 *
 */

include_once 'vendor/Aura.Router-2.3.0/autoload.php';
include_once 'lib/Dispatcher.php';

use Aura\Router\RouterFactory;

$router_factory = new RouterFactory;
$router = $router_factory->newInstance();

$router->addGet(null, '/{controller}/{action}/{id}')->addTokens(array('controller' => 'employee', 'action' => 'shifts|coworkers|summary|managers', 'id' => '\d+'));
$router->addPost(null, '/{controller}/{action}')->addTokens(array('controller' => 'shift', 'action' => 'create'));
$router->addGet(null, '/{controller}/{action}')->addTokens(array('controller' => 'shift', 'action' => 'index'));
$router->addPut(null, '/{controller}/{action}/{id}')->addTokens(array('controller' => 'shift', 'action' => 'update', 'id' => '\d+'));

?>
