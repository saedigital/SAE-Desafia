<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 27/06/19
 * Time: 13:32
 */

namespace App\Lib;


use Throwable;

class HttpException extends \Exception
{

    public function __construct(string $message = 'Página não encontrada.', int $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render() {
        header('Content-Type: text/html; charset=utf-8');
        http_response_code($this->getCode());
        $view = new View();
        $view->setView('template/error.php');
        $vars = [
            'code'=>$this->getCode(),
            'message'=>$this->getMessage()
        ];
        return $view->renderView($vars);
    }
}