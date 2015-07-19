<?php
/**
 * __autoload() function to automatically include classes
 *
 * Searches the following paths
 * - models/, if class name contains 'Model'
 * - lib/
 *
 * Updated 2015-07-18 to use spl_autoload_register()
 *
 */
function autoload_lib ($class_name) {
	$include_path = dirname(dirname(__FILE__));
	if (strpos($class_name, 'Model') !== false && file_exists($include_path . '/models/' . $class_name . '.php')) {
		require_once $include_path . '/models/' . $class_name . '.php';
	} else if (file_exists($include_path . '/lib/' . $class_name . '.php')) {
		require_once $include_path . '/lib/' . $class_name . '.php';
	}
}

spl_autoload_register('autoload_lib');

?>
