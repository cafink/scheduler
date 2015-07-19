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

$router->add(null, '/{controller}/{action}/{id}')->addTokens(array('action' => 'edit|delete|view|feed', 'id' => '\d+'));
$router->add(null, '/{controller}/{action}');
$router->add(null, '/{controller}')->addValues(array('action' => 'index'));

?>
