<?php

namespace ApplicationTest\Controller;

use Application\Entity\Event;
use Application\Entity\Seat;
use Application\Service\FirebaseService;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Mockery;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

/**
 * Class InitFirebaseConsoleControllerTest
 * @package ApplicationTest\Controller
 */
class InitFirebaseConsoleControllerTest extends AbstractConsoleControllerTestCase
{
    public function setUp()
    {
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();

        $mockery = new Mockery();
        $entityManager = $mockery->mock(EntityManager::class);
        $entityManager->shouldReceive('getRepository')->andReturn($entityManager);

        $seats = new ArrayCollection();
        $seat = new Seat([
            'seatNumber' => 1,
            'status' => Seat::CONFIRMED_RESERVATION,
            'ticketAmount' => 19.9,
            'customerEmail' => 'andrecardosodev@gmail.com'
        ]);
        $seats->add($seat);

        $data = [
            'id' => 1,
            'name' => 'Teste',
            'description' => 'Teste',
            'location' => 'Teste',
            'capacity' => 20,
            'ticketAmount' => 19.9,
            'showDate' => new DateTime(),
            'seats' => $seats
        ];

        $entity = new Event($data);

        $entityManager->shouldReceive('findBy')->andReturn([$entity]);


        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService(EntityManager::class, $entityManager);

        $firebaseService = $mockery->mock(FirebaseService::class);
        $firebaseService->shouldReceive('addEvent')->andReturn($firebaseService);
        $firebaseService->shouldReceive('delete')->andReturn($firebaseService);
        $firebaseService->shouldReceive('update')->andReturn($firebaseService);

        $serviceManager->setService(FirebaseService::class, $firebaseService);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function indexAction()
    {
        $this->dispatch('init-firebase');

        $this->assertConsoleOutputContains('TEMPO REAL!!!');
    }
}
