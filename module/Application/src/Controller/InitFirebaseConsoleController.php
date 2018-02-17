<?php

namespace Application\Controller;

use Application\Entity\Event;
use Application\Entity\Seat;
use Application\Service\FirebaseService;
use Doctrine\ORM\EntityManager;
use Zend\Console\Request as ConsoleRequest;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class InitFirebaseConsoleController
 * @package Application\Controller
 */
class InitFirebaseConsoleController extends AbstractActionController
{
    use ControllerTrait;

    /**
     * @return string
     */
    public function indexAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof ConsoleRequest){
            throw new \RuntimeException('You can only use this action from a console!');
        }

        /** @var EntityManager $entityManager */
        $entityManager = $this->getServiceManager()->get(EntityManager::class);

        $events = $entityManager->getRepository(Event::class)->findBy(['active' => true]);
        $firebaseService = $this->getServiceManager()->get(FirebaseService::class);

        echo PHP_EOL . 'Adicionando ' . count($events) . ' eventos no firebase.' . PHP_EOL . PHP_EOL;

        foreach($events as $event) {
            $firebaseService->addEvent($event);
        }

        return 'Feito. Agora a selecao das poltronas sera em TEMPO REAL!!!' . PHP_EOL . PHP_EOL;
    }
}