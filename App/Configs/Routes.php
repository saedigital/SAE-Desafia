<?php
$Routes = array();

$Routes['NotFound'] = [
    'Controller' => "\\Controller\\Error",
    "Method" => "NotFound",
    'Type' => \System\Response::GET,  //GET|POST|PUT|DELETE|ALL
    'Headers' => [
        "HTTP/1.0 404 Not Found"
    ],
    'RequireHeader' => []
];

/**
 * Rotas do sistema
 */

//Tela de Login
$Routes['Login'] = [
    'Controller' => "\\Controller\\Index",
    "Method" => "Login",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];

//Request Ajax Login
$Routes['User/Login'] = [
    'Controller' => "\\Controller\\Index",
    "Method" => "ActionLogin",
    'Type' => \System\Response::POST,
    'Headers' => [],
    'RequireHeader' => []
];

//Dashboard
$Routes['Painel/Dashboard'] = [
    'Controller' => "\\Controller\\Painel\\Dashboard",
    "Method" => "Index",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];

//Todos os espetáculo
$Routes['Painel/Espetaculos'] = [
    'Controller' => "\\Controller\\Painel\\Espetaculos",
    "Method" => "Index",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];

//Cadastrar espetáculo
$Routes['Painel/Espetaculos/Novo'] = [
    'Controller' => "\\Controller\\Painel\\Espetaculos",
    "Method" => "Novo",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];

//Cadastrar espetáculo AJAX
$Routes['Painel/Espetaculos/Cadastrar'] = [
    'Controller' => "\\Controller\\Painel\\Espetaculos",
    "Method" => "Cadastrar",
    'Type' => \System\Response::POST,
    'Headers' => [],
    'RequireHeader' => []
];


//Cadastrar espetáculo AJAX
$Routes['Painel/Espetaculos/Edit'] = [
    'Controller' => "\\Controller\\Painel\\Espetaculos",
    "Method" => "Edit",
    'Type' => \System\Response::POST,
    'Headers' => [],
    'RequireHeader' => []
];

//Cadastrar Reserva
$Routes['Painel/Poltrona/Reserve'] = [
    'Controller' => "\\Controller\\Painel\\Poltrona",
    "Method" => "Reserve",
    'Type' => \System\Response::POST,
    'Headers' => [],
    'RequireHeader' => []
];

//Financeiro
$Routes['Painel/Financeiro'] = [
    'Controller' => "\\Controller\\Painel\\Financeiro",
    "Method" => "Index",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];