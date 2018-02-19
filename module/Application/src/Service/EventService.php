<?php

namespace Application\Service;

use Application\Entity\Event;
use DateTime;
use Zend\Hydrator\ClassMethods;

/**
 * Class EventService
 * @package Application\Service
 */
class EventService extends BaseService
{
    /**
     * @param array $data
     * @return Event|mixed|null|object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function save(array $data)
    {
        if (!isset($data['id']) || empty($data['id'])) {
            $event = new Event($data);
            $this->entityManager->persist($event);
        } else {
            $event = $this->entityManager->find(Event::class, (int)$data['id']);
            unset($data['id']);
            (new ClassMethods(false))->hydrate($data, $event);
            $event->setModified(new DateTime());
        }

        $this->entityManager->flush();

        return $event;
    }

    /**
     * @param $id
     * @return bool|mixed
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($id)
    {
        $event = $this->entityManager->getReference(Event::class, (int)$id);
        $this->entityManager->remove($event);
        $this->entityManager->flush();

        return true;
    }
}
