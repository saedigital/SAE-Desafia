<?php 

namespace App\Service;

class EventService extends BaseService
{
    public function getList()
    {
        $sql = 'SELECT id, title, description, ticket_value, tickets_limit, tickets_sold, time  FROM events LIMIT :limit';
        $rs = $this->db->list($sql, [10]);
        
        foreach ($rs as $key => $value) {
            if ($value['tickets_sold'] > 0) {
                $value['ticket_value'] = str_replace(',', '.', $value['ticket_value']);
                $totalCalc = $value['ticket_value'] * $value['tickets_sold'];
                $rs[$key]['total'] = number_format($totalCalc, 2, ',', '.');
            } else {
                $rs[$key]['total'] = number_format(0, 2, ',', '.');
            }
            
        }
        return $rs;
    }

    public function add($data)
    {
        if (!$this->validAdd($data)) {
            $this->status = false;
            return 0;
        }

        $insert = ' INSERT INTO events (title, description, ticket_value, tickets_limit, tickets_sold, time) 
                    VALUES (:title, :description, :ticket_value, :tickets_limit, :tickets_sold, :time) ';

        $stmt = $this->db->getConnection()->prepare($insert);

        $dateTimeFormat = (new \DateTime())->format('Y-m-d H:i:s');
        $defaultSold = 0;
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':ticket_value', $data['ticket_value']);
        $stmt->bindParam(':tickets_limit', $data['tickets_limit']);
        $stmt->bindParam(':tickets_sold', $defaultSold);
        $stmt->bindParam(':time',  $dateTimeFormat);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function validAdd($data)
    {   
        $sql = ' SELECT id  
                 FROM events 
                 WHERE title = :title';
        $rs = $this->db->item($sql, [$data['title']]);

        return ($rs == false);
    }

    public function update($data)
    {   
        $insert = ' UPDATE events SET 
                    title = :title, 
                    description = :description, 
                    ticket_value = :ticket_value, 
                    tickets_limit = :tickets_limit 
                    WHERE id = :id ';

        $stmt = $this->db->getConnection()->prepare($insert);

        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':ticket_value', $data['ticket_value']);
        $stmt->bindParam(':tickets_limit', $data['tickets_limit']);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function getEventData($id)
    {
        $sqlData = 'SELECT id, title, description, ticket_value, tickets_limit, tickets_sold, time  
                    FROM events WHERE id = :id';
        $rs = $this->db->item($sqlData, [$id]);
        return $rs;
    }

    public function updateSold($data)
    {
        $insert = ' UPDATE events SET 
                    tickets_sold = :tickets_sold 
                    WHERE id = :id ';

        $stmt = $this->db->getConnection()->prepare($insert);

        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':tickets_sold', $data['tickets_sold']);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $deleteEvents = ' DELETE FROM events  
                    WHERE id = :id ';

        $stmt = $this->db->getConnection()->prepare($deleteEvents);

        $stmt->bindParam(':id', $id);
        $stmt->execute();


        $delete = ' DELETE FROM tickets  
                    WHERE event_id = :event_id ';

        $stmt = $this->db->getConnection()->prepare($delete);

        $stmt->bindParam(':event_id', $id);
        $stmt->execute();

        return $stmt->rowCount();
    }
}