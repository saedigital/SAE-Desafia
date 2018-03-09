<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'shows';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['shows/(:any)/(:num)'] = 'shows/$1/$2';
$route['admin'] = 'admin/dashboard';
$route['admin/(:any)/(:num)'] = 'admin/$1/$2';
$route['admin/login'] = 'users/login';
$route['admin/logout'] = 'users/logout';
$route['login'] = 'users/login';
$route['logout'] = 'users/logout';
