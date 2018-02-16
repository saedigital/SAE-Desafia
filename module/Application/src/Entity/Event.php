<?php declare(strict_types=1);

namespace Application\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Event
 * @package Application\Entity
 *
 * @ORM\Table(name="events")
 * @ORM\Entity()
 */
class Event extends AbstractEntity
{
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $location;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $capacity;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     */
    private $ticketAmount;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $showDate;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Seat", mappedBy="event")
     */
    private $seats;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Event
     */
    public function setName(string $name): Event
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Event
     */
    public function setDescription(string $description): Event
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Event
     */
    public function setLocation(string $location): Event
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    /**
     * @param int $capacity
     * @return Event
     */
    public function setCapacity(int $capacity): Event
    {
        $this->capacity = $capacity;
        return $this;
    }

    /**
     * @return float
     */
    public function getTicketAmount(): float
    {
        return (float)$this->ticketAmount;
    }

    /**
     * @param float $ticketAmount
     * @return Event
     */
    public function setTicketAmount(float $ticketAmount): Event
    {
        $this->ticketAmount = $ticketAmount;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getShowDate(): DateTime
    {
        return $this->showDate;
    }

    /**
     * @param DateTime $showDate
     * @return Event
     */
    public function setShowDate(DateTime $showDate): Event
    {
        $this->showDate = $showDate;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getSeats(): Collection
    {
        return $this->seats;
    }

    /**
     * @param Collection $seats
     * @return Event
     */
    public function setSeats(Collection $seats): Event
    {
        $this->seats = $seats;
        return $this;
    }

    public function __construct(array $data = [])
    {
        $this->seats = new ArrayCollection();
        parent::__construct($data);
    }
}
