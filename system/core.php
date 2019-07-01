<?php
require_once('vendor/autoload.php'); 
require_once('system/config/config.php'); //Configurações de funcionamento padrão estão nesse arquivo.
require_once('config/config.php');

$dotenv = Dotenv\Dotenv::create(__DIR__.'/../'); //Configurações de funcionamento locais estão nesse arquivo.
$dotenv->load();

$config = new Config();
$config->setDataBaseConfig($_ENV['DATABASE_HOST'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD'], $_ENV['DATABASE_NAME']);
$config->setRotasPadroes(gethostname(), $_ENV['MAIN_CONTROLLER']);

require_once('system/controladores/ControleDeRotas.php');
$controlederotas = new ControleDeRotas($config);