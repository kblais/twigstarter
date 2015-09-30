<?php

use Sabre\HTTP;

if (!function_exists('base_path')) {
	function base_path($path = null) {
		return __DIR__ . '/..' . $path;
	}
}

if (!function_exists('views_path')) {
	function views_path($path = null) {
		return __DIR__ . '/..' . getenv('VIEWS_PATH') . $path;
	}
}

if (!function_exists('app_path')) {
	function app_path($path = null) {
		return __DIR__ . '/../app' . $path;
	}
}

if (!function_exists('dd')) {
	function dd()
	{
		var_dump(func_get_args());
		die();
	}
}

if (!function_exists('twig')) {
	function twig($views_path)
	{
		$directory = new RecursiveDirectoryIterator($views_path);
		$iterator = new RecursiveIteratorIterator($directory);
		$regex = new RegexIterator($iterator, '/^.+\.twig$/i', RecursiveRegexIterator::GET_MATCH);

		$tpl_files = [];

		foreach ($regex as $file) {
			$tpl_files[str_replace([$views_path . DIRECTORY_SEPARATOR, '.twig', DIRECTORY_SEPARATOR], ['', '', '.'], $file[0])] = file_get_contents($file[0]);
		}

		$loader = new Twig_Loader_Array($tpl_files);

		$twig = new Twig_Environment($loader);

		/**
		 * Load Twig extensions
		 */
		$twig->addExtension(new Twig_Extensions_Extension_Text());

		return $twig;
	}
}

if (!function_exists('view')) {
	function view($tpl_name, $data = [], $status_code = 200) {
		$response = new HTTP\Response();

		$response->setStatus($status_code);
		$response->setBody(twig(views_path())->render($tpl_name, $data));

		HTTP\Sapi::sendResponse($response);
	}
}
