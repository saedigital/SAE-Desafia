<?php

namespace App\Controllers;

use App\Factory;

abstract class BaseController 
{
    private $parameters;
    protected $factory;

    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function getFactory()
    {
        return $this->factory;    
    }

    /**
     * @para array $parameters
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return array
     */
    protected function getParametersRoute()
    {
        return $this->parameters;
    }

    /**
     * @return array
     */
    public function getParameters() {
        $requestVars = [];
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            parse_str(file_get_contents("php://input"), $requestVars);
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $content = trim(file_get_contents("php://input"));
            $requestVars = json_decode($content, true);
        } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $requestVars = $_GET;
        }
        return $this->inputFilter($requestVars);
    }

    public function inputFilter($requestVars)
    {
        $removeVars = ['SELECT', 'FROM', 'LIKE', 'RLIKE', 'DROP', 'DELETE'];
        
        foreach ($requestVars as $key => $value) {
            $requestVars[$key] = str_ireplace($removeVars, '', $value);
        }
        return $requestVars;
    }

    /**
     * @param $name
     * @return string
     */
    public function getParameter($name) {
        $pars = $this->getParameters();
        return isset($pars[$name]) ? $pars[$name] : '';
    }
}
