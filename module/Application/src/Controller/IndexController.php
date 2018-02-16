<?php

namespace Application\Controller;

use Application\Entity\Event;
use Doctrine\ORM\EntityManager;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends BaseController
{
    /**
     * @return array|ViewModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function indexAction()
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getServiceManager()->get(EntityManager::class);

        $data = $entityManager->getRepository(Event::class)->findBy(
            ['active' => true],
            ['showDate' => 'ASC']
        );

        return new ViewModel([
            'data' => $data
        ]);
    }

    public function viewAction()
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getServiceManager()->get(EntityManager::class);
        $eventId = (int)$this->params()->fromRoute('id', 0);

        $event = $entityManager->getRepository(Event::class)
                    ->findOneBy(['active' => true, 'id' => $eventId]);

        if ($eventId === 0 || !$event) {
            return $this->redirect()->toRoute('/not-found');
        }

        return new ViewModel([
            'event' => $event
        ]);
    }
}
