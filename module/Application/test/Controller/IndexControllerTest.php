<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ApplicationTest\Controller;

use Application\Controller\IndexController;
use Application\Entity\Event;
use Application\Entity\Seat;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Mockery;
use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Parameters;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
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
        $entityManager->shouldReceive('findOneBy')->andReturn($entity);
        $entityManager->shouldReceive('persist')->andReturn($entityManager);
        $entityManager->shouldReceive('flush')->andReturn($entityManager);

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService(EntityManager::class, $entityManager);
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class); // as specified in router's controller name alias
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('home');
    }

    public function testView()
    {
        $this->dispatch('/event/1', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class);
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('event');
    }

    public function testViewRedirect()
    {
        $this->dispatch('/event/0', 'GET');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class);
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('event');
    }

    public function testConfirmationGet()
    {
        $this->dispatch('/event/1/confirmation?email=andrecardosodev@gmail.com', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class);
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('event-confirmation');
    }

    public function testConfirmationGetRedirect()
    {
        $this->dispatch('/event/0/confirmation?email=andrecardosodev@gmail.com', 'GET');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class);
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('event-confirmation');
    }

    public function testConfirmationPost()
    {
        $this->dispatch('/event/1/confirmation?email=andrecardosodev@gmail.com', 'POST', []);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class);
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('event-confirmation');
    }
}
