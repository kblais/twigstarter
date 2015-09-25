<?php

$data = [
	'email' => $faker->email,
	'text' => $faker->text,
];

$response->setStatus(200);
$response->setBody($twig->render('example', $data));
