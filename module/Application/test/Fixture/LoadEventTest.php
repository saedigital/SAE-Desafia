<?php

namespace ApplicationTest\Fixture;

use Application\Fixture\LoadEvent;
use Doctrine\ORM\EntityManager;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * Class LoadEventTest
 * @package ApplicationTest\Fixture
 */
class LoadEventTest extends TestCase
{
    /**
     * @test
     */
    public function load()
    {
        $objectManager = Mockery::mock(EntityManager::class);
        $objectManager->shouldReceive('persist')->andReturn($objectManager);
        $objectManager->shouldReceive('flush')->andReturn($objectManager);

        $loadEvent = new LoadEvent();
        $this->assertTrue($loadEvent->load($objectManager));
    }
    /**
     * @test
     */
    public function getOrder()
    {
        $loadEvent = new LoadEvent();
        $this->assertEquals(0, $loadEvent->getOrder());
    }
}
