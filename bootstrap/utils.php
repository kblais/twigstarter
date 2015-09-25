<?php

use Sabre\HTTP;

if (!function_exists('dd')) {
	function dd()
	{
		var_dump(func_get_args());
		die();
	}
}

if (!function_exists('send_response')) {
	function send_response($response)
	{
		HTTP\Sapi::sendResponse($response);
	}
}

if (!function_exists('register_twig')) {
	function register_twig($views_path)
	{
		$directory = new RecursiveDirectoryIterator($views_path);
		$iterator = new RecursiveIteratorIterator($directory);
		$regex = new RegexIterator($iterator, '/^.+\.twig$/i', RecursiveRegexIterator::GET_MATCH);

		$tpl_files = [];

		foreach ($regex as $file) {
			$tpl_files[str_replace([$views_path . '/', '.twig', '/'], ['', '', '.'], $file[0])] = file_get_contents($file[0]);
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
