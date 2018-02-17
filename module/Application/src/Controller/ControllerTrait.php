<?php

namespace Application\Controller;

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
     */
    protected function renderJson($data)
    {
        $content = json_encode($data);
        header('Content-Type: application/json');
        print $content;
        exit;
    }
}
