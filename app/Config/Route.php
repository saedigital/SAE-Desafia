<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 14:45
 */

namespace App\Config;


use App\Lib\HttpException;
use App\Lib\View;

class Route
{

    /**
     * @var string
     */
    private $expression, $controller, $method;

    /**
     * Route constructor.
     * @param string $expression
     * @param string $controller
     * @param string $method
     */
    public function __construct(string $expression, string $controller, string $method)
    {
        $this->setExpression($expression);
        $this->setController($controller);
        $this->setMethod($method);
    }

    /**
     * @return bool|mixed|void
     */
    public function checkAndRun() {
        $exp = $this->getExpression();
        if(strlen($exp) < 2)
            return strlen($_SERVER['REQUEST_URI']) < 3 ? $this->run([]) : $this->e404();

        preg_match("/^$exp/", trim($_SERVER['REQUEST_URI'], '/'), $result);

        if(count($result))
            return $this->run($result);

        return false;
    }

    private function sanitize($param) {
        if(!$param)
            return null;

        $output = trim($param, '/');
        return is_string($output) && !empty($output) ? $output : null;
    }

    public function run(array $_params) {
        array_shift($_params);

        $params = array_map([$this, 'sanitize'], $_params);
        $controller = $this->getController();
        $controllerClass = "App\\Controller\\$controller";
        $instace = new $controllerClass();
        $action = $this->getMethod();
        if (!method_exists($instace, $action))
            return $this->e404();

        $method = new \ReflectionMethod($instace, $action);

        if (!$method->isPublic())
            return $this->e404();

        if(count($params) < $method->getNumberOfRequiredParameters())
            return $this->e404();

        $output = call_user_func_array([$instace, $action], $params);

        if($output instanceof HttpException):
            echo $output->render();
            return false;
        elseif(is_string($output)):
            echo $output;
        elseif(is_array($output)):
            header('Content-Type: application/json');
            echo json_encode($output);
        endif;
        return true;
    }

    public function e404() {
        echo (new HttpException())->render();
        return false;
    }
    /**
     * @return string
     */
    public function getExpression(): string
    {
        return $this->expression;
    }

    /**
     * @param string $expression
     */
    public function setExpression(string $expression): void
    {
        $this->expression = $expression;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     */
    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }


}