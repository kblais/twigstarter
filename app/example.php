<?php

$data = [
	'email' => $faker->email,
	'text' => $faker->text,
];

view('example', $data);
