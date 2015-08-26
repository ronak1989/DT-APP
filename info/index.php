<?php
session_start();
error_reporting(E_ALL);
require_once 'constants.php';
require_once _CONST_CLASS_PATH . 'AltoRouter.php';
$_router = new AltoRouter();
$_router->map('GET', '/', 'info#getHomepage');
$_router->map('POST', '/verify', 'info#doVerification');
$_router->map('POST', '/register', 'info#register');
$_router->map('POST', '/login', 'info#login');
$_router->map('POST', '/signup', 'info#register');
$_router->map('POST', '/signin', 'info#login');
$_router->map('POST', '/change-password', 'info#changePassword');
$_router->map('POST', '/forgot-password', 'info#forgotPassword');
$_router->map('GET', '/logout', 'info#logout');
$controller_name = null;
$method_name = null;
$id = null;
$match = $_router->match();
if ($match) {
	if (!empty($match['params']['id'])) {
		$id = $match['params']['id'];
	}

	switch (trim($match['target'])) {
		case '':
			$controller_name = $match['params']['c'];
			$method_name = $match['params']['a'];
			break;
		default:
			$class_params = explode("#", $match['target']);
			$controller_name = $class_params[0];
			$method_name = $class_params[1];
			break;
	}

	require_once _CONST_CONTROLLER_PATH . $controller_name . '.php';
	$obj = new $controller_name($id, $_POST);
	if ($method_name == 'list') {
		$method_name = "details";
	}
	$obj->$method_name();
} else {
	/**
	 * Return 404 Header
	 *
	 */
	// no route was matched
	//header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
session_write_close();
?>
