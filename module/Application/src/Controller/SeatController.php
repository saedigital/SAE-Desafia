<?php

namespace Application\Controller;

use Application\Entity\Event;
use Application\Entity\Seat;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Zend\Http\Request;

/**
 * Class SeatController
 * @package Application\Controller
 */
class SeatController extends BaseController
{
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

            if ($event) {
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
                    $event->setSeats($seatsCollection);
                    $entityManager->flush();

                    $response = [
                        'statusCode' => 201,
                        'message' => 'Suas poltronas foram reservadas!'
                    ];
                }
            }
        }

        $content = json_encode($response);
        header('Content-Type: application/json');
        print $content;
        exit;
    }
}
