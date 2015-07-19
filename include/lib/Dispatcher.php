<?php
/**
 * Dispatcher
 *
 * @author Gabe Martin-Dempesy
 * @version $Id: Dispatcher.php 3932 2009-04-28 21:02:38Z seanbug $
 * @copyright Mudbug Media, 2007-04-18
 * @package Chitin
 * @subpackage Dispatcher
 */


/**
 * Convert between URL's and routes, and instantiates Controllers
 * @package Chitin
 * @subpackage Dispatcher
 */
class Dispatcher {

	function controllerFileExists ($controller_name) {
		return ChitinFunctions::file_exists_in_include_path('controllers/' . $controller_name . '.php');
	}

	/**
	 * Fetch a URL for given coordinates
	 *
	 * Examples:
	 * - UserAddController       => user/add
	 * - AccountCreditcardAdd    => account/creditcard/add
	 * - AdminController         => admin
	 *
	 * @param string $controller_name
	 * @return string Directory-style path
	 */
	function controllerToShort ($controller_name) {

		$path = preg_replace(
			array(
			'/Controller$/',
			'/([A-Z])/',
			'/^\//'
			),

			array(
			'',
			'/${1}',
			''
			),

			$controller_name
		);

		return strtolower($path);
	}

	/**
	 * Fetch coordinates for a URL
	 *
	 * @param string $path
	 * @return array Coordinates
	 */
	function shortToController ($path) {
		$controller_name = str_replace('/', ' ', $path);
		$controller_name = ucwords($controller_name);
		$controller_name = str_replace(' ','', $controller_name);
		$controller_name .= 'Controller';
		return $controller_name;
	}

	/**
	 * Sends an Apache-style '404' error message to the browser and exits
	 *
	 * @return void
	 */
	function send404 () {
		header("HTTP/1.0 404 Not Found");

		if (!isset($GLOBALS['config']['errordocument']['404']) || strlen($GLOBALS['config']['errordocument']['404']) < 1) $GLOBALS['config']['errordocument']['404'] = '404.php';

		$path = ($GLOBALS['config']['errordocument']['404'][0] == '/') ?
			$_SERVER['DOCUMENT_ROOT'] . $GLOBALS['config']['errordocument']['404'] : // Absolute paths are from the DOCUMENT_ROOT
			dirname(__FILE__) . '/../../' . $GLOBALS['config']['errordocument']['404']; // Relative paths are from include/'s parent

		if (file_exists($path)) {
			ChitinLogger::log(__CLASS__ . '::' . __FUNCTION__ . ": Could not locate a matching route for URL, sending 404 document in '$path'");
			include_once $path;
			echo "\n<!-- Chitin -->";
		} else {
			ChitinLogger::log(__CLASS__ . '::' . __FUNCTION__ . ": Could not locate custom document in '$path', using internal.");
	echo <<<EOF
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<!-- Chitin -->
<h1>Not Found</h1>
<p>The requested URL {$_SERVER['REQUEST_URI']} was not found on this server.</p>
<hr>
{$_SERVER['SERVER_SIGNATURE']}
</body></html>
EOF;
		}
	ChitinLogger::flush();
	die();
	}

}

?>
