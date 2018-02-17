<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManager;

/**
 * Class BaseService
 * @package Application\Service
 */
abstract class BaseService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    public function __construct(ServiceManager $serviceManager)
    {
        $this->entityManager = $serviceManager->get(EntityManager::class);
        $this->serviceManager = $serviceManager;
    }
}
