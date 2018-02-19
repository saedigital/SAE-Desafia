<?php

namespace ApplicationTest\Entity;

use Application\Entity\Event;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class EventTest
 * @package ApplicationTest\Entity
 */
class EventTest extends TestCase
{
    /**
     * @test
     */
    public function getterAndSetters()
    {
        $data = [
            'id' => 1,
            'name' => 'Teste',
            'description' => 'Teste',
            'location' => 'Teste',
            'capacity' => 30,
            'ticketAmount' => 19.9,
            'showDate' => new DateTime(),
            'seats' => new ArrayCollection()
        ];

        $entity = new Event($data);

        $this->assertNotNull($entity->getId());
        $this->assertNotNull($entity->getName());
        $this->assertNotNull($entity->getDescription());
        $this->assertNotNull($entity->getLocation());
        $this->assertNotNull($entity->getCapacity());
        $this->assertNotNull($entity->getTicketAmount());
        $this->assertNotNull($entity->getShowDate());
        $this->assertNotNull($entity->getSeats());
    }
}
