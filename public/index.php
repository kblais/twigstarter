<?php

use Sabre\HTTP;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap/bootstrap.php';

if (file_exists(app_path() . '/' . request()->getPath() . '.php')) {
	require_once app_path() . '/' . request()->getPath() . '.php';
}
elseif (file_exists(app_path() . '/' . request()->getPath() . '/index.php')) {
	require_once app_path() . '/' . request()->getPath() . '/index.php';
}
else {
	$response = new HTTP\Response();
	$response->setStatus(404);
	$response->setBody('Page not found');

	HTTP\Sapi::sendResponse($response);
}
