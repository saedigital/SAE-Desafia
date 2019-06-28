<?php
require 'environment.php';

global $config;

$config = array();

if(ENVIRONMENT == "development") {
	$config['dbname'] = 'desenv';
	$config['host'] = '127.0.0.1:33306';
	$config['dbuser'] = 'desenv';
	$config['dbpass'] = 'desenv';
	define("BASE_URL", 'http://' . $_SERVER['SERVER_NAME'] . ':' .$_SERVER['SERVER_PORT'] .'/');
} else {
	$config['dbname'] = '';
	$config['host'] = '';
	$config['dbuser'] = '';
	$config['dbpass'] = '';
	define("BASE_URL",  'http://' . $_SERVER['SERVER_NAME'] . '/');
}
