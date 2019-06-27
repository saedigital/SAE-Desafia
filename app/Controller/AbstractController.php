<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 16:16
 */

namespace App\Controller;


use App\Lib\HttpException;
use App\Lib\View;

abstract class AbstractController
{

    /**
     * @var View
     */
    private $view;

    public function __construct()
    {
        $this->view = new View();
        $this->view->setTemplate('template/index.php');
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return $this->view;
    }

    public function render(string $file, array $vars = []) {
        return $this->view()->setView($file)->render($vars);
    }

    public function e404($message = 'Página não encontrada.') {
        return new HttpException($message, 404);
    }

    public function e405($message = 'Method Not Allowed.') {
        return new HttpException($message, 500);
    }

    public function e500($message = 'Server error.') {
        return new HttpException($message, 500);
    }


}