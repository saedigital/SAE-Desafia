<?php

namespace Application\Service;

use Application\Entity\AbstractEntity;
use DateTime;
use Doctrine\ORM\EntityManager;
use Zend\Hydrator\ClassMethods;
use Zend\ServiceManager\ServiceManager;

/**
 * Class BaseService
 * @package Application\Service
 */
abstract class BaseService implements ServiceInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var AbstractEntity
     */
    protected $entity;

    public function __construct(ServiceManager $serviceManager)
    {
        $this->entityManager = $serviceManager->get(EntityManager::class);
        $this->serviceManager = $serviceManager;
    }

    /**
     * @param array $data
     * @return mixed|null|object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function save(array $data)
    {
        $entityName = get_called_class();
        $entityName = explode('\\', $entityName);
        $entityName = $entityName[0] . '\\Entity\\' . str_replace('Service', '', end($entityName));

        if (!isset($data['id']) || empty($data['id'])) {
            $entity = new $entityName($data);
            $this->entityManager->persist($entity);
        } else {
            $entity = $this->entityManager->find($entityName, (int)$data['id']);
            unset($data['id']);
            (new ClassMethods(false))->hydrate($data, $entity);
            $entity->setModified(new DateTime());
        }

        $this->entityManager->flush();

        return $entity;
    }

    /**
     * @param $id
     * @return bool|mixed
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($id)
    {
        if (!$this->entity) {
            $entityName = get_called_class();
            $entityName = explode('\\', $entityName);
            $entityName = $entityName[0] . '\\Entity\\' . str_replace('Service', '', end($entityName));
            $this->entity = $entityName;
        }

        $entity = $this->entityManager->getReference($this->entity, (int)$id);
        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        return true;
    }
}
