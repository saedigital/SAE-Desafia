<?php

namespace ApplicationTest\Service;

use Application\Entity\Event;
use Application\Service\EventService;
use DateTime;
use Doctrine\ORM\EntityManager;
use Mockery;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;

/**
 * Class EventServiceTest
 * @package ApplicationTest\Service
 */
class EventServiceTest extends TestCase
{
    /**
     * @test
     */
    public function saveAddingNewEvent()
    {
        $service = new EventService($this->getServiceManager());
        $data = [
            'name' => 'Teste',
            'description' => 'Teste',
            'location' => 'Teste',
            'capacity' => 30,
            'ticketAmount' => 19.9,
            'showDate' => new DateTime()
        ];

        $result = $service->save($data);

        $this->assertNotNull($result);
        $this->assertInstanceOf(Event::class, $result);
    }

    /**
     * @test
     */
    public function saveEditingExistentEvent()
    {
        $service = new EventService($this->getServiceManager());
        $data = [
            'id' => 1,
            'name' => 'Teste',
            'description' => 'Teste',
            'location' => 'Teste',
            'capacity' => 30,
            'ticketAmount' => 19.9,
            'showDate' => new DateTime()
        ];

        $result = $service->save($data);

        $this->assertNotNull($result);
        $this->assertInstanceOf(Event::class, $result);
    }

    /**
     * @test
     */
    public function delete()
    {
        $service = new EventService($this->getServiceManager());

        $result = $service->delete(1);

        $this->assertTrue($result);
    }

    private function getServiceManager()
    {
        $mockery = new Mockery();

        $entityManager = $mockery->mock(EntityManager::class);
        $entityManager->shouldReceive('persist')->andReturn($entityManager);
        $entityManager->shouldReceive('flush')->andReturn($entityManager);
        $entityManager->shouldReceive('remove')->andReturn($entityManager);
        $entityManager->shouldReceive('getReference')->andReturn($entityManager);
        $entityManager->shouldReceive('find')->andReturn(new Event());

        $serviceManager = $mockery->mock(ServiceManager::class);
        $serviceManager->shouldReceive('get')->andReturn($entityManager);

        return $serviceManager;
    }
}