<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class BaseController
 * @package Application\Controller
 */
class BaseController extends AbstractActionController
{
    /**
     * Alias for backward compatibility
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected function getServiceLocator()
    {
        return $this->getServiceManager();
    }

    /**
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected function getServiceManager()
    {
        return $this->getEvent()->getApplication()->getServiceManager();
    }
}
