<?php 

namespace App\Service;

use App\Service\EventService;

class TicketService extends BaseService
{

    /**
     * @var EventService
     */
    protected $serviceEvent;

    /**
     * @param EventService serviceEvent
     */
    public function setServiceEvent(EventService $serviceEvent) 
    {
        $this->serviceEvent = $serviceEvent;
    }

    public function getList()
    {
        $sql = 'SELECT * FROM tickets LIMIT :limit';
        $rs = $this->db->list($sql, [10]);
        return $rs;
    }

    public function getTicketData($id)
    {
        $sqlData = 'SELECT id, event_id, number_ticket  FROM tickets WHERE id = :id';
        $rs = $this->db->item($sqlData, [$id]);
        return $rs;
    }

    public function dataEvent($eventId)
    {
        $eventData = $this->serviceEvent->getEventData($eventId);
        if (!$eventData) {
            $this->status = false;
            return 0;
        }
        
        $sqlData = ' SELECT t.id, t.event_id, t.number_ticket, t.reserve_number  
                     FROM events e 
                     LEFT JOIN tickets t ON e.id = t.event_id 
                     WHERE t.event_id = :id ';

        $ticketsData = $this->db->list($sqlData, [$eventId]);
        return [
            'event' => $eventData,
            'tickets_data' => $ticketsData,
        ];

    }

    public function cancelBookingEvent($ticketId)
    {
        $ticketData = $this->getTicketData($ticketId);
        if (!$ticketData) {
            $this->status = false;
            return 0;
        }
        $eventId = $ticketData['event_id'];
        $eventData = $this->serviceEvent->getEventData($eventId);
        if (!$eventData) {
            $this->status = false;
            return 0;
        }

        $dataSold = [
            'tickets_sold' => $eventData['tickets_sold'] - 1,
            'id' => $eventId,
        ];
        $this->serviceEvent->updateSold($dataSold);

        $sqlDel = ' DELETE FROM tickets WHERE id = :id ';
        $stmt = $this->db->getConnection()->prepare($sqlDel);
        $stmt->bindParam(':id', $ticketId);
        $stmt->execute();

        return 1;
    }

    public function bookingEvent($eventId, $list = [])
    {
        $eventData = $this->serviceEvent->getEventData($eventId);
        if (!$eventData) {
            $this->status = false;
            return [];
        }
        
        $checkExcludeItems = [];
        foreach ($list as $item) {
            $checkExcludeItems[] = $item;
            if (!$this->checkReserveNumber($eventId, $item)) {
                
                continue;
            }
            $numberTicket = $this->getNumberTicket();
            $dateTimeFormat = (new \DateTime())->format('Y-m-d H:i:s');

            $sqlInsert = ' INSERT INTO tickets (event_id, number_ticket, reserve_number, time) 
                            VALUES (:event_id, :number_ticket, :reserve_number, :time) ';

            $stmt = $this->db->getConnection()->prepare($sqlInsert);
            $stmt->bindParam(':event_id', $eventId);
            $stmt->bindParam(':number_ticket',  $numberTicket);
            $stmt->bindParam(':reserve_number',  $item);
            $stmt->bindParam(':time',  $dateTimeFormat);
            $stmt->execute();
            $eventData = $this->serviceEvent->getEventData($eventId);
            $dataSold = [
                'tickets_sold' => $eventData['tickets_sold'] + 1,
                'id' => $eventId,
            ];
            $this->serviceEvent->updateSold($dataSold);
        }
        
        for ($i = 1; $i <= $eventData['tickets_limit']; ++$i) {
            if (!in_array($i, $checkExcludeItems)) {
                $this->cancelBookingEventNumber($eventId, $i);
            }
        }
    

        return []; 
    }

    public function cancelBookingEventNumber($eventId, $number)
    {
        if ($this->checkReserveNumber($eventId, $number)) {
            return 0;
        }
        $eventData = $this->serviceEvent->getEventData($eventId);
        if (!$eventData) {
            $this->status = false;
            return 0;
        }

        $dataSold = [
            'tickets_sold' => $eventData['tickets_sold'] - 1,
            'id' => $eventId,
        ];
        $this->serviceEvent->updateSold($dataSold);

        $sqlDel = ' DELETE FROM tickets WHERE event_id = :event_id AND reserve_number = :reserve_number ';
        $stmt = $this->db->getConnection()->prepare($sqlDel);
        
        $stmt->bindParam(':event_id', $eventId);
        $stmt->bindParam(':reserve_number', $number);
        $stmt->execute();

        return 1;
    }

    public function checkReserveNumber($eventId, $item)
    {
        $sqlCheck = ' SELECT id 
                      FROM tickets 
                      WHERE event_id = :event_id 
                      AND reserve_number = :reserve_number';

        $rs = $this->db->item($sqlCheck, [$eventId, $item]);
        
        return ($rs == false);
    }

    public function getNumberTicket()
    {
        while (true) {
            $number = $this->generateNumberTicket();
            $sqlCheck = ' SELECT number_ticket 
                          FROM tickets 
                          WHERE number_ticket = :number_ticket ';
            $rs = $this->db->list($sqlCheck, [$number]);        
            if (!$rs) {
                break;
            }
        }
        return $number; 
    }

    public function generateNumberTicket()
    {
        return (new \DateTime())->format('u') . rand(11, 99) . rand(55, 99) . rand(10, 55);
    }

    public function truncate()
    {
        $sqlDel = ' DELETE FROM tickets WHERE id > 0 ';
        $stmt = $this->db->getConnection()->prepare($sqlDel);
        $stmt->execute();
    }
}