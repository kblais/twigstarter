<?php

use Sabre\HTTP;

if (!function_exists('base_path')) {
	/**
	 * Get the base path
	 * @param	string	$path	Path to append to the base path of the app
	 * @return	string			Base path
	 */
	function base_path($path = null) {
		return __DIR__ . '/..' . $path;
	}
}

if (!function_exists('views_path')) {
	/**
	 * Get the views path
	 * @param	string	$path	Path to append to the views path of the app
	 * @return	string			Views path
	 */
	function views_path($path = null) {
		return __DIR__ . '/..' . getenv('VIEWS_PATH') . $path;
	}
}

if (!function_exists('app_path')) {
	/**
	 * Get the app path
	 * @param	string	$path	Path to append to the app path of the app
	 * @return	string			App path
	 */
	function app_path($path = null) {
		return __DIR__ . '/../app' . $path;
	}
}

if (!function_exists('dd')) {
	/**
	 * Dump the given args
	 * @param	mixed
	 */
	function dd()
	{
		var_dump(func_get_args());
		die();
	}
}

if (!function_exists('twig')) {
	/**
	 * Get a Twig instance
	 * @return	Twig_Environment 				Twig environment
	 */
	function twig()
	{
		$directory = new RecursiveDirectoryIterator(views_path());
		$iterator = new RecursiveIteratorIterator($directory);
		$regex = new RegexIterator($iterator, '/^.+\.twig$/i', RecursiveRegexIterator::GET_MATCH);

		$tpl_files = [];

		foreach ($regex as $file) {
			$tpl_files[str_replace([views_path() . DIRECTORY_SEPARATOR, '.twig', DIRECTORY_SEPARATOR], ['', '', '.'], $file[0])] = file_get_contents($file[0]);
		}

		$loader = new Twig_Loader_Array($tpl_files);

		$twig = new Twig_Environment($loader);

		/**
		 * Load Twig extensions
		 */
		$twig->addExtension(new Twig_Extensions_Extension_Text());

		$route_function = new Twig_SimpleFunction('route', function()
		{
			return '/';
		});

		$twig->addFunction($route_function);

		return $twig;
	}
}

if (!function_exists('request')) {
	/**
	 * Get the current request
	 * @return	Sabre\HTTP\Sapi	Current request
	 */
	function request() {
		$request = HTTP\Sapi::getRequest();

		$request->setBaseUrl(getenv('BASE_URL'));

		return $request;
	}
}

if (!function_exists('view')) {
	/**
	 * Sends compiled view
	 * @param	string	$tpl_name		Name of the template (in "dot" notation)
	 * @param	array	$data			Array containing your data; empty by default
	 * @param	integer	$status_code	HTTP status code for the response; 200 by default
	 */
	function view($tpl_name, $data = [], $status_code = 200) {
		$response = new HTTP\Response();

		$response->setStatus($status_code);
		$response->setBody(twig()->render($tpl_name, $data));

		HTTP\Sapi::sendResponse($response);
	}
}
