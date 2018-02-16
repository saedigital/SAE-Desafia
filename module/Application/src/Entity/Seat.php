<?php declare(strict_types=1);

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Seat
 * @package Application\Entity
 *
 * @ORM\Table(name="event_seats")
 * @ORM\Entity()
 */
class Seat extends AbstractEntity
{
    /**
     * @var Event
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="seats")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $seatNumber;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $customerEmail;

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * @param Event $event
     * @return Seat
     */
    public function setEvent(Event $event): Seat
    {
        $this->event = $event;
        return $this;
    }

    /**
     * @return int
     */
    public function getSeatNumber(): int
    {
        return $this->seatNumber;
    }

    /**
     * @param int $seatNumber
     * @return Seat
     */
    public function setSeatNumber(int $seatNumber): Seat
    {
        $this->seatNumber = $seatNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerEmail(): string
    {
        return $this->customerEmail;
    }

    /**
     * @param string $customerEmail
     * @return Seat
     */
    public function setCustomerEmail(string $customerEmail): Seat
    {
        $this->customerEmail = $customerEmail;
        return $this;
    }
}
