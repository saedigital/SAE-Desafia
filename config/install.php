<?php
error_reporting(E_ALL);
require 'autoload.php';

\App\Config\Bootstrap::init(realpath(__DIR__ .  DIRECTORY_SEPARATOR .'..'));

$createTable = function ($table) {
    App\Lib\DB::exec(file_get_contents(__DIR__ . "/tables/$table.sql"));
};
$createTable('local');
$createTable('local_poltrona');
$createTable('espetaculo');
$createTable('espetaculo_reserva');