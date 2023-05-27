<?php

require_once 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('','DefaultController');

Routing::get('signin','AuthController');
Routing::get('signup','AuthController');
Routing::post('login','AuthController');
Routing::post('register','AuthtController');

Routing::post('addTeam','TeamController');
Routing::get('myTeams','TeamController');
Routing::get('allTeams','TeamController');





Routing::run($path);