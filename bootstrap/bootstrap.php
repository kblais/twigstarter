<?php

use Dotenv\Dotenv;
use Faker\Factory as FakerFactory;

require_once __DIR__ . '/utils.php';

/**
 * Load environment variables
 */
$dotenv = new Dotenv(base_path());
$dotenv->load();

$faker = FakerFactory::create('fr_FR');
