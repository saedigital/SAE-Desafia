<?php

namespace Application\Core;

class Model
{
    public $conexao;
    public $paramentros;

    public function __construct()
    {
        require __DIR__ . '/../../conexao.php';
        $this->paramentros = $configDb;
    }

    public function conexaoDbal()
    {    
        $conexaoConfig = new \Doctrine\DBAL\Configuration();
        return $this->conexao = \Doctrine\DBAL\DriverManager::getConnection($this->paramentros, $conexaoConfig);
    }
    
}