<?php

namespace ApplicationTest\Entity;

use Application\Entity\Event;
use Application\Entity\Seat;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class SeatTest
 * @package ApplicationTest\Entity
 */
class SeatTest extends TestCase
{
    /**
     * @test
     */
    public function getterAndSetters()
    {
        $data = [
            'id' => 1,
            'event' => new Event(),
            'seatNumber' => 12,
            'customerEmail' => 'andrecardosodev@gmail.com',
            'status' => Seat::CONFIRMED_RESERVATION,
            'created' => new DateTime(),
            'active' => true
        ];

        $entity = new Seat($data);
        $entity->updateProperties($data);

        $this->assertNotNull($entity->getId());
        $this->assertNotNull($entity->getEvent());
        $this->assertNotNull($entity->getSeatNumber());
        $this->assertNotNull($entity->getCustomerEmail());
        $this->assertNotNull($entity->getStatus());
        $this->assertNotNull($entity->isActive());
        $this->assertNotNull($entity->getCreated());
        $this->assertNotNull($entity->getModified());
        $this->assertNotNull($entity->toArray());
    }
}
