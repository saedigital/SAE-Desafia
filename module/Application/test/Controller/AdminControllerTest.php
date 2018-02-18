<?php

namespace ApplicationTest\Controller;

use Application\Controller\AdminController;
use Application\Entity\Event;
use Application\Entity\Seat;
use Application\Form\EventForm;
use Application\Service\FirebaseService;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Mockery;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Class AdminControllerTest
 * @package ApplicationTest\Controller
 */
class AdminControllerTest extends AbstractHttpControllerTestCase
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
        $entityManager->shouldReceive('getReference')->andReturn($entityManager);

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
        $entityManager->shouldReceive('find')->andReturn($entity);
        $entityManager->shouldReceive('findOneBy')->andReturn($entity, new Seat());
        $entityManager->shouldReceive('persist')->andReturn($entityManager);
        $entityManager->shouldReceive('remove')->andReturn($entityManager);
        $entityManager->shouldReceive('flush')->andReturn($entityManager);

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
        $this->dispatch('/admin/event/index', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(AdminController::class); // as specified in router's controller name alias
        $this->assertControllerClass('AdminController');
        $this->assertMatchedRouteName('admin-event');
    }

    /**
     * @test
     * @throws \Exception
     */
    public function viewAction()
    {
        $this->dispatch('/admin/event/view/1', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(AdminController::class); // as specified in router's controller name alias
        $this->assertControllerClass('AdminController');
        $this->assertMatchedRouteName('admin-event');
    }

    /**
     * @test
     * @throws \Exception
     */
    public function addAction()
    {
        $form = new EventForm();

        $data = [
            'name' => 'Teste',
            'description' => 'teste',
            'location' => 'teste',
            'capacity' => 30,
            'ticketAmount' => 19.9,
            'showDate' => date('d/m/Y H:i'),
            'csrf' => $form->get('csrf')->getValue()
        ];

        $this->dispatch('/admin/event/add', 'POST', $data);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('application');
        $this->assertControllerName(AdminController::class); // as specified in router's controller name alias
        $this->assertControllerClass('AdminController');
        $this->assertMatchedRouteName('admin-event');
    }

    /**
     * @test
     * @throws \Exception
     */
    public function addActionInvalidData()
    {
        $data = [
            'name' => 'Teste',
            'description' => 'teste',
            'location' => 'teste',
            'capacity' => 30,
            'ticketAmount' => 19.9,
            'showDate' => date('d/m/Y H:i')
        ];

        $this->dispatch('/admin/event/add', 'POST', $data);
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(AdminController::class); // as specified in router's controller name alias
        $this->assertControllerClass('AdminController');
        $this->assertMatchedRouteName('admin-event');
    }

    /**
     * @test
     * @throws \Exception
     */
    public function editAction()
    {
        $form = new EventForm();

        $data = [
            'id' => 1,
            'name' => 'Teste',
            'description' => 'teste',
            'location' => 'teste',
            'capacity' => 30,
            'ticketAmount' => 19.9,
            'showDate' => date('d/m/Y H:i'),
            'csrf' => $form->get('csrf')->getValue()
        ];

        $this->dispatch('/admin/event/edit/1', 'POST', $data);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('application');
        $this->assertControllerName(AdminController::class); // as specified in router's controller name alias
        $this->assertControllerClass('AdminController');
        $this->assertMatchedRouteName('admin-event');
    }

    /**
     * @test
     * @throws \Exception
     */
    public function editActionDecreasingCapacity()
    {
        $form = new EventForm();

        $data = [
            'id' => 1,
            'name' => 'Teste',
            'description' => 'teste',
            'location' => 'teste',
            'capacity' => 10,
            'ticketAmount' => 19.9,
            'showDate' => date('d/m/Y H:i'),
            'csrf' => $form->get('csrf')->getValue()
        ];

        $this->dispatch('/admin/event/edit/1', 'POST', $data);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('application');
        $this->assertControllerName(AdminController::class); // as specified in router's controller name alias
        $this->assertControllerClass('AdminController');
        $this->assertMatchedRouteName('admin-event');
    }

    /**
     * @test
     * @throws \Exception
     */
    public function editActionInvalidData()
    {
        $data = [
            'id' => 1,
            'name' => 'Teste',
            'description' => 'teste',
            'location' => 'teste',
            'capacity' => 30,
            'ticketAmount' => 19.9,
            'showDate' => date('d/m/Y H:i')
        ];

        $this->dispatch('/admin/event/edit/1', 'POST', $data);
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(AdminController::class); // as specified in router's controller name alias
        $this->assertControllerClass('AdminController');
        $this->assertMatchedRouteName('admin-event');
    }

    /**
     * @test
     * @throws \Exception
     */
    public function editActionInvalidId()
    {
        $data = [
            'id' => 1,
            'name' => 'Teste',
            'description' => 'teste',
            'location' => 'teste',
            'capacity' => 30,
            'ticketAmount' => 19.9,
            'showDate' => date('d/m/Y H:i')
        ];

        $this->dispatch('/admin/event/edit/0', 'POST', $data);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('application');
        $this->assertControllerName(AdminController::class); // as specified in router's controller name alias
        $this->assertControllerClass('AdminController');
        $this->assertMatchedRouteName('admin-event');
    }

    /**
     * @test
     * @throws \Exception
     */
    public function addActionInvalidIdEqualsToZero()
    {
        $form = new EventForm();

        $data = [
            'id' => 0,
            'name' => 'Teste',
            'description' => 'teste',
            'location' => 'teste',
            'capacity' => 30,
            'ticketAmount' => 19.9,
            'showDate' => date('d/m/Y H:i'),
            'csrf' => $form->get('csrf')->getValue()
        ];

        $this->dispatch('/admin/event/add', 'POST', $data);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('application');
        $this->assertControllerName(AdminController::class); // as specified in router's controller name alias
        $this->assertControllerClass('AdminController');
        $this->assertMatchedRouteName('admin-event');
    }

    /**
     * @test
     * @throws \Exception
     */
    public function deleteAction()
    {
        $this->dispatch('/admin/event/delete/1', 'POST', []);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('application');
        $this->assertControllerName(AdminController::class); // as specified in router's controller name alias
        $this->assertControllerClass('AdminController');
        $this->assertMatchedRouteName('admin-event');
    }
}
