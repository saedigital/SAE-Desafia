<?php

namespace ApplicationTest\Service;

use Application\Entity\Event;
use Application\Entity\Seat;
use Application\Service\FirebaseService;
use DateTime;
use Firebase\FirebaseLib;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * Class FirebaseServiceTest
 * @package ApplicationTest\Service
 */
class FirebaseServiceTest extends TestCase
{
    /**
     * @return Mockery\MockInterface
     */
    protected function getFirebaseLib()
    {
        $mockery = new Mockery();

        $firebaseLib = $mockery->mock(FirebaseLib::class);
        $firebaseLib->shouldReceive('set')->andReturn($firebaseLib);
        $firebaseLib->shouldReceive('update')->andReturn($firebaseLib);
        $firebaseLib->shouldReceive('delete')->andReturn($firebaseLib);

        return $firebaseLib;
    }

    /**
     * @test
     */
    public function set()
    {
        $firebaseService = new FirebaseService($this->getFirebaseLib(), 'events');

        $this->assertTrue($firebaseService->set(
            1,
            ['12' =>
                [
                    'status' => Seat::CONFIRMED_RESERVATION,
                    'seatNumber' => 12
                ]
            ]
        ));
    }

    /**
     * @test
     */
    public function update()
    {
        $firebaseService = new FirebaseService($this->getFirebaseLib(), 'events');

        $this->assertTrue($firebaseService->update(
            1,
            ['12' =>
                [
                    'status' => Seat::CONFIRMED_RESERVATION,
                    'seatNumber' => 12
                ]
            ]
        ));
    }

    /**
     * @test
     */
    public function delete()
    {
        $firebaseService = new FirebaseService($this->getFirebaseLib(), 'events');

        $this->assertTrue($firebaseService->delete(1));
    }

    /**
     * @test
     */
    public function addEvent()
    {
        $firebaseService = new FirebaseService($this->getFirebaseLib(), 'events');
        $event = new Event([
            'id' => 1,
            'name' => 'Teste',
            'description' => 'Teste',
            'location' => 'Teste',
            'capacity' => 30,
            'ticketAmount' => 19.9,
            'showDate' => new DateTime()
        ]);

        $this->assertTrue($firebaseService->addEvent($event));
    }
}
