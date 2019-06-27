<?php

error_reporting(E_ALL);
require '../config/autoload.php';
require '../config/route.php';


\App\Config\Bootstrap::init(realpath(__DIR__ .  DIRECTORY_SEPARATOR .'..'));