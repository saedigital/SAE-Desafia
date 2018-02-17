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
    const PRE_BOOKING = 0;
    const CONFIRMED_RESERVATION = 1;

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
     * @var int
     * @ORM\Column(type="integer", nullable=false, options={"default": 0})
     */
    private $status;

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

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Seat
     */
    public function setStatus(int $status): Seat
    {
        $this->status = $status;
        return $this;
    }

    public function __construct(array $data = [])
    {
        $this->token = md5((string)time());
        parent::__construct($data);
    }
}
