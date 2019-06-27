<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 14:45
 */

namespace App\Config;


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
            return strlen($_SERVER['REQUEST_URI']) < 3 ? $this->run([]) : $this->httpException(404, 'Página não encontrada.');

        preg_match("/^$exp/", trim($_SERVER['REQUEST_URI'], '/'), $result);

        if(count($result))
            return $this->run($result);

        return false;
    }

    public function run(array $params) {
        array_shift($params);
        $controller = $this->getController();
        $controllerClass = "App\\Controller\\$controller";
        $instace = new $controllerClass();
        $action = $this->getMethod();
        if (!method_exists($instace, $action))
            return $this->httpException(404, 'Página não encontrada.');

        $method = new \ReflectionMethod($instace, $action);

        if (!$method->isPublic())
            return $this->httpException(404, 'Página não encontrada.');

        if(count($params) < $method->getNumberOfRequiredParameters())
            return $this->httpException(404, 'Página não encontrada.');

        call_user_func_array([$instace, $action], $params);
        return true;
    }

    public function httpException($code, $message) {
        echo $code . '<br/>' . $message;
        return true;
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