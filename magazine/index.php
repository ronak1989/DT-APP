<?php
session_start();
error_reporting(E_ALL);
if (isset($_GET['_q'])) {
	$_SESSION['q'] = $_GET['_q'];
}
require_once 'constants.php';
require_once _CONST_CLASS_PATH . 'AltoRouter.php';
$_router = new AltoRouter();
$_router->map('GET', '/', 'magazine#getHomepage');
$_router->map('POST', '/verify', 'magazine#doVerification');
$_router->map('POST', '/register', 'magazine#register');
$_router->map('POST', '/login', 'magazine#login');
$_router->map('POST', '/signup', 'magazine#register');
$_router->map('POST', '/signin', 'magazine#login');
$_router->map('POST', '/change-password', 'magazine#changePassword');
$_router->map('POST', '/forgot-password', 'magazine#forgotPassword');
$_router->map('GET', '/logout', 'magazine#logout');
$_router->map('POST', '/ask-dt', 'magazine#askDt');
$_router->map('GET', '/search-stock', 'magazine#searchStock');

$_router->map('POST', '/redirect', 'magazine#gatewayRedirect');
$_router->map('POST', '/gateway-response', 'magazine#gatewayResponse');

$_router->map('POST', '/payment-success', 'magazine#gatewayResponseSuccess');
$_router->map('GET', '/payment-error', 'magazine#gatewayResponseError');

$_router->map('GET', '/sneak-preview/[a:issue]', 'magazine#showPartialBook');
$_router->map('GET', '/magazine/[a:issue]', 'magazine#showSubscribedBook');
$_router->map('GET', '/view/document', 'magazine#showDocument');

$controller_name = null;
$method_name = null;
$id = null;
$issue = null;
$match = $_router->match();
if ($match) {
	if (!empty($match['params']['id'])) {
		$id = $match['params']['id'];
	}

	if (!empty($match['params']['issue'])) {
		$issue = $match['params']['issue'];
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
	$obj = new $controller_name($id, $_POST, $issue);
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
