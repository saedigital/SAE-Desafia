<?php

namespace Application\Controller;

use Application\Entity\Event;
use Application\Entity\Seat;
use Application\Service\FirebaseService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

/**
 * Class SeatController
 * @package Application\Controller
 */
class SeatController extends AbstractActionController
{
    use ControllerTrait;

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function asyncPickAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();
        $isTest = (bool)$this->params()->fromQuery('test', false);

        $response = [
            'statusCode' => 405,
            'message' => 'Método não permitido'
        ];

        if ($request->isPost()) {
            $response = [
                'statusCode' => 404,
                'message' => 'Uma ou mais poltronas selecionadas não estão mais disponíveis, por favor confira o mapa do local novamente'
            ];

            $data = $request->getPost()->toArray();

            /** @var EntityManager $entityManager */
            $entityManager = $this->getServiceManager()->get(EntityManager::class);

            /** @var Event $event */
            $event = $entityManager->getRepository(Event::class)
                ->findOneBy(['active' => true, 'id' => $data['eventId']]);

            if (!$event) {
                $response['message'] = 'Evento inválido';
                return $this->renderJson($response, $isTest);
            }

            $allSelectedSeatsAreFree = true;
            $seatRepository = $entityManager->getRepository(Seat::class);
            $seatsCollection = new ArrayCollection();

            foreach ($data['seats'] as $seatNumber) {
                $seat = new Seat([
                    'event' => $event,
                    'seatNumber' => $seatNumber,
                    'customerEmail' => $data['email'],
                    'status' => Seat::PRE_BOOKING
                ]);

                $seatsCollection->add($seat);

                if ($seatRepository->findOneBy([
                    'seatNumber' => $seatNumber,
                    'event' => $event
                ])) {
                    $allSelectedSeatsAreFree = false;
                }
            }

            if ($allSelectedSeatsAreFree) {
                foreach ($seatsCollection as $seat) {
                    $entityManager->persist($seat);
                }
                $this->updateSeatsStatusOnFirebase($event, $data['seats']);
                $event->setSeats($seatsCollection);
                $entityManager->flush();

                $response = [
                    'statusCode' => 201,
                    'message' => 'Suas poltronas foram reservadas!',
                    'data' => [
                        'url' => '/event/' . $event->getId() . '/confirmation?email=' . $data['email']
                    ]
                ];
            }
        }

        return $this->renderJson($response, $isTest);
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
        foreach ($seats as $seat) {
            $data[$seat] = [
                'seatNumber' => $seat,
                'status' => Seat::PRE_BOOKING
            ];
        }

        $firebaseService->update($event->getId(), $data);
    }
}
