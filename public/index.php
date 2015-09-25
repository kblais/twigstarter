<?php

$base_path = __DIR__ . '/..';
$app_path = __DIR__ . '/../app';
$views_path = __DIR__ . '/../resources/views';

require_once $base_path . '/vendor/autoload.php';
require_once $base_path . '/bootstrap/bootstrap.php';

if (file_exists($app_path . '/' . $request->getPath() . '.php')) {
	require_once $app_path . '/' . $request->getPath() . '.php';
}
elseif (file_exists($app_path . '/' . $request->getPath() . '/index.php')) {
	require_once $app_path . '/' . $request->getPath() . '/index.php';
}
else {
	$response->setStatus(404);
	$response->setBody('Page not found');
}

send_response($response);
