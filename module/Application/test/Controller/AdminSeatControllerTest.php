<?php

namespace ApplicationTest\Controller;

use Application\Controller\AdminSeatController;
use Application\Entity\Event;
use Application\Entity\Seat;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Mockery;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Class AdminSeatControllerTest
 * @package ApplicationTest\Controller
 */
class AdminSeatControllerTest extends AbstractHttpControllerTestCase
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
            'capacity' => 30,
            'ticketAmount' => 19.9,
            'showDate' => new DateTime(),
            'seats' => $seats
        ];

        $entity = new Event($data);

        $entityManager->shouldReceive('findBy')->andReturn([$entity]);
        $entityManager->shouldReceive('findOneBy')->andReturn($entity, new Seat());
        $entityManager->shouldReceive('persist')->andReturn($entityManager);
        $entityManager->shouldReceive('remove')->andReturn($entityManager);
        $entityManager->shouldReceive('flush')->andReturn($entityManager);

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService(EntityManager::class, $entityManager);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function asyncCancelAction()
    {
        $this->dispatch('/admin/async-seat-cancel?test=true', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(AdminSeatController::class); // as specified in router's controller name alias
        $this->assertControllerClass('AdminSeatController');
        $this->assertMatchedRouteName('admin-async-seat-cancel');
    }

    /**
     * @test
     * @throws \Exception
     */
    public function asyncCancelActionPost()
    {
        $data = [
            'eventId' => 1,
            'seatNumber' => 2
        ];

        $this->dispatch('/admin/async-seat-cancel?test=true', 'POST', $data);
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(AdminSeatController::class); // as specified in router's controller name alias
        $this->assertControllerClass('AdminSeatController');
        $this->assertMatchedRouteName('admin-async-seat-cancel');
    }
}
