<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 16:15
 */

namespace App\Lib;


class View
{

    /**
     * @var string
     */
    private $template, $view;

    public function render(array $vars = []) {
        header('Content-Type: text/html; charset=utf-8');
        $vars['__content'] = $this->getFileContent($this->getView(), $vars);
        return $this->getFileContent($this->getTemplate(), $vars);
    }

    public function renderView(array $vars = []) {
        return $this->getFileContent($this->getView(), $vars);
    }

    public function getFileContent($file, array $vars = []) {
        ob_start();
        extract($vars);
        require $file;
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    /**
     * @return string
     */
    public function getView(): string
    {
        return $this->view;
    }

    /**
     * @param string $view
     * @return $this
     */
    public function setView(string $view)
    {
        $this->view = VIEW_PATH . $view;
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplate(string $template)
    {
        $this->template = VIEW_PATH . $template;
        return $this;
    }




}