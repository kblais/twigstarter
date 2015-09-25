<?php

use Sabre\HTTP;
use Dotenv\Dotenv;
use Faker\Factory as FakerFactory;

require_once __DIR__ . '/utils.php';

/**
 * Load environment variables
 */
$dotenv = new Dotenv($base_path);
$dotenv->load();

$request = HTTP\Sapi::getRequest();

if (getenv('BASE_URL'))
	$request->setBaseUrl(getenv('BASE_URL'));

$twig = register_twig($views_path);

$response = new HTTP\Response();

$faker = FakerFactory::create('fr_FR');
