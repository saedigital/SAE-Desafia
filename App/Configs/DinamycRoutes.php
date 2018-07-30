<?php
$DynamicRoutes = [];

/**
 * Rota para visualização do Espetaculo
 */
$DynamicRoutes['Painel/Espetaculos/View/:num'] = [
    'Controller' => "\\Controller\\Painel\\Espetaculos",
    "Method" => "Visualizar",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];

$DynamicRoutes['Painel/Espetaculos/Delete/:num'] = [
    'Controller' => "\\Controller\\Painel\\Espetaculos",
    "Method" => "Delete",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];

$DynamicRoutes['Painel/Espetaculos/Editar/:num'] = [
    'Controller' => "\\Controller\\Painel\\Espetaculos",
    "Method" => "Editar",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];


$DynamicRoutes['Painel/Poltrona/Cancel/:num'] = [
    'Controller' => "\\Controller\\Painel\\Poltrona",
    "Method" => "Cancel",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];

$DynamicRoutes['Painel/Poltrona/Delete/:num'] = [
    'Controller' => "\\Controller\\Painel\\Poltrona",
    "Method" => "Delete",
    'Type' => \System\Response::GET,
    'Headers' => [],
    'RequireHeader' => []
];