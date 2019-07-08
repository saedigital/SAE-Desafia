<?php 

namespace App;

use App\Db\DataBase;

use App\Service\EventService;
use App\Service\TicketService;

class Factory 
{
    private $items = [];

    public function __construct()
    {
        $this->config();
    }

    public function config()
    {
        $self = $this;

        $this->items = [
            'events' => function() {
                $dataBase = new DataBase();
                return new EventService($dataBase);
            },
            'tickets' => function() use ($self) {
                $dataBase = new DataBase();
                $eventService = $self->get('events');
                $ticketService = new TicketService($dataBase);
                $ticketService->setServiceEvent($eventService);
                return $ticketService;
            },
        ];
    }
    
    /**
     * @param string $item
     * @return Object
     */
    public function get($item)
    {
        if (!isset($this->items[$item])) {
            throw new Exception("Unconfigured item : " . $item, 1);
                
        }
        return $this->items[$item]();
    }
}

