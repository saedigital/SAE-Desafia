<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 16:16
 */

namespace App\Controller;


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


}