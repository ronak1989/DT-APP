<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
require_once 'constants.php';
require_once _CONST_CLASS_PATH . 'AltoRouter.php';
$router = new AltoRouter();
$router->addMatchTypes(array('cat-url' => '[a-z\-]++', 'news-url' => '[a-z0-9\-]++'));

/** Website **/
#Homepage URL
$router->map('GET', '/', 'news#getHomepage', 'WEBSITE_HOMEPAGE');
#SEARCH URL
$router->map('GET', '/search', 'news#getSearchPage', 'WEBSITE_SEARCH');
#LATEST NEWS URL
$router->map('GET', '/latest-news?/[i:pg]?', 'news#getLatestNewsPage', 'WEBSITE_LATESTNEWS');
$router->map('GET', '/latest-news/[i:pg].json', 'news#getLatestNewsPageJson', 'WEBSITE_LATESTNEWS_JSON');
#Category URL
$router->map('GET', '/[cat-url:category]?/[i:pg]?', 'news#getCategorylistingPage', 'WEBSITE_CATEGORYPAGE');
$router->map('GET', '/[cat-url:category]/[i:pg].json', 'news#getCategorylistingPageJson', 'WEBSITE_CATEGORYPAGE_JSON');
#Article URL
$router->map('GET', '/[i:id]/[news-url]', 'news#getArticlePage', 'WEBSITE_ARTICLEPAGE');

$controller_name = null;
$method_name = null;
$id = null;
$pg = null;
$category = null;
$match = $router->match();
if ($match) {
	switch (trim($match['target'])) {
		case '':
			$controller_name = $match['params']['c'];
			$method_name = $match['params']['a'];
			if (!empty($match['params']['id'])) {
				$id = $match['params']['id'];
			}
			break;
		default:
			$class_params = explode("#", $match['target']);
			$controller_name = $class_params[0];
			$method_name = $class_params[1];
			if (!empty($match['params']['id'])) {
				$id = $match['params']['id'];
			}
			if (!empty($match['params']['category'])) {
				$category = $match['params']['category'];
			}
			if (!empty($match['params']['pg'])) {
				$pg = $match['params']['pg'];
			}
			break;
	}

	require_once _CONST_CONTROLLER_PATH . $controller_name . '.php';
	if ($controller_name == 'news') {
		$obj = new $controller_name($id, $category, $pg, $_REQUEST);
	} else {
		$obj = new $controller_name($id, $_REQUEST);
	}

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
