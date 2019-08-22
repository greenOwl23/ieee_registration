<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//Configuration
require '../vendor/autoload.php';
require '../src/config/db.php';
//Participant Routes
require '../src/routes/participant.php';
$app->run();