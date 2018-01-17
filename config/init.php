<?php
/**
 * Conexão com o banco de dados
 * Criado em janeiro/2018 
 * @author: Ander
 */

$host = 'localhost'; //nome do host do MySQL
$database = 'db_teatro'; //O nome do banco de dados
$user_bd = 'root'; //Usuário do banco de dados MySQL
$password_bd = ''; //Senha do banco de dados MySQL

define('DB_HOST', $host);
define('DB_USER', $user_bd);
define('DB_PASS', $password_bd);
define('DB_NAME', $database);
 
// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
 
//Função para conectar com o banco de dados
function db_connect() {
    try {
        $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    } catch (PDOException $ex) {
        echo $ex->getCode() . $ex->getMessage();
    }
    return $PDO;
}
?>