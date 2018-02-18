<?php

namespace Application\Controller;

use Application\Entity\Event;
use Application\Entity\Seat;
use Application\Service\FirebaseService;
use Doctrine\ORM\EntityManager;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class AdminSeatController
 * @package Application\Controller
 */
class AdminSeatController extends AbstractActionController
{
    use ControllerTrait;
    
    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function asyncCancelAction()
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
                'message' => 'Poltrona não disponível'
            ];

            $data = $request->getPost()->toArray();

            /** @var EntityManager $entityManager */
            $entityManager = $this->getServiceManager()->get(EntityManager::class);

            /** @var Event $event */
            $event = $entityManager->getRepository(Event::class)
                ->findOneBy(['active' => true, 'id' => $data['eventId']]);

            if ($event && $seat = $entityManager->getRepository(Seat::class)
                    ->findOneBy([
                        'event' => $event,
                        'seatNumber' => $data['seatNumber']
                    ])) {
                $entityManager->remove($seat);
                $entityManager->flush();

                /** @var FirebaseService $firebaseService */
                $firebaseService = $this->getServiceManager()->get(FirebaseService::class);
                $firebaseService->update($event->getId(),[
                    $data['seatNumber'] => [
                        'seatNumber' => $data['seatNumber'],
                        'status' => Seat::AVAILABLE
                    ]
                ]);

                $response = [
                    'statusCode' => 200,
                    'message' => 'Reserva cancelada'
                ];
            }
        }

        return $this->renderJson($response, $isTest);
    }
}
