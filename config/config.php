<?php

$_ENV['MAIN_CONTROLLER'] = 'Spectacle';

$_ENV['ASSETS_VERSION'] = '0.5';

$host = $_SERVER['HTTP_HOST'];

switch ($host) {
  case 'localhost':
    $_ENV['ENVIRONMENT'] = 'development';
    break;
  case 'localhost.localtest':
    $_ENV['ENVIRONMENT'] = 'testing';
    break;
  default:
    $_ENV['ENVIRONMENT'] = 'production';
		break;
}