<?php

namespace Application\Controller;
use Zend\View\Model\ViewModel;

/**
 * Trait ControllerTrait
 * @package Application\Controller
 */
trait ControllerTrait
{
    /**
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected function getServiceManager()
    {
        return $this->getEvent()->getApplication()->getServiceManager();
    }

    /**
     * @param $data
     * @param bool $isTest
     * @return ViewModel
     * @codeCoverageIgnore
     */
    protected function renderJson($data, $isTest = false)
    {
        if ($isTest) {
            $this->layout('layout/ajax');
            return new ViewModel();
        }

        $content = json_encode($data);
        header('Content-Type: application/json');
        print $content;
        exit;
    }
}
