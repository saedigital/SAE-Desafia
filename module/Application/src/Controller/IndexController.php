<?php

namespace Application\Controller;

use Application\Entity\Event;
use Application\Entity\Seat;
use Application\Service\FirebaseService;
use Doctrine\ORM\EntityManager;
use Exception;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{
    use ControllerTrait;

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

    /**
     * @return \Zend\Http\Response|ViewModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function viewAction()
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getServiceManager()->get(EntityManager::class);
        $eventId = (int)$this->params()->fromRoute('id', 0);

        $event = $entityManager->getRepository(Event::class)
            ->findOneBy(['active' => true, 'id' => $eventId]);

        if ($eventId === 0 || !$event) {
            return $this->redirect()->toUrl('/not-found');
        }

        return new ViewModel([
            'event' => $event
        ]);
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     * @throws Exception
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function confirmationAction()
    {
        $eventId = (int)$this->params()->fromRoute('id', 0);
        $email = $this->params()->fromQuery('email');

        /** @var EntityManager $entityManager */
        $entityManager = $this->getServiceManager()->get(EntityManager::class);

        /** @var Event $event */
        $event = $entityManager->getRepository(Event::class)
            ->findOneBy(['active' => true, 'id' => $eventId]);

        if ($eventId === 0 || !$event) {
            $this->flashMessenger()->setNamespace('error')->addMessage('Evento não localizado');
            return $this->redirect()->toRoute('home');
        }

        $mySeats = [];

        /** @var Seat $seat */
        foreach ($event->getSeats() as $seat) {
            if ($seat->getCustomerEmail() == $email) {
                $mySeats[] = $seat;
            }
        }

        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            /** @var Seat $seat */
            foreach ($mySeats as $seat) {
                $seat->setStatus(Seat::CONFIRMED_RESERVATION);
                $entityManager->persist($seat);
            }
            $this->updateSeatsStatusOnFirebase($event, $mySeats);
            $entityManager->flush();

            $this->flashMessenger()->setNamespace('success')->addMessage('Reserva confirmada');
            return $this->redirect()->toRoute('event', ['id' => $eventId]);
        }

        return new ViewModel([
            'event' => $event,
            'mySeats' => $mySeats
        ]);
    }

    /**
     * @param Event $event
     * @param array $seats
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function updateSeatsStatusOnFirebase(Event $event, array $seats)
    {
        /** @var FirebaseService $firebaseService */
        $firebaseService = $this->getServiceManager()->get(FirebaseService::class);

        $data = [];
        /** @var Seat $seat */
        foreach ($seats as $seat) {
            $data[$seat->getSeatNumber()] = [
                'seatNumber' => $seat->getSeatNumber(),
                'status' => Seat::CONFIRMED_RESERVATION
            ];
        }

        $firebaseService->update($event->getId(), $data);
    }
}
