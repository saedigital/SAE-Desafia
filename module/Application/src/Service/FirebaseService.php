<?php

namespace Application\Service;

use Application\Entity\Event;
use Application\Entity\Seat;
use Firebase\FirebaseLib;

/**
 * Class FirebaseService
 * @package Application\Service
 */
class FirebaseService
{
    /**
     * @var FirebaseLib
     */
    private $firebase;

    /**
     * @var string
     */
    private $defaultPath;

    /**
     * FirebaseService constructor.
     * @param FirebaseLib $firebase
     * @param $defaultPath
     */
    public function __construct(FirebaseLib $firebase, $defaultPath)
    {
        $this->firebase = $firebase;
        $this->defaultPath = $defaultPath;
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function set($id, $data)
    {
        $this->firebase->set($this->defaultPath . $id . '/seats', $data);
        return true;
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function update($id, $data)
    {
        $this->firebase->update($this->defaultPath . $id . '/seats', $data);
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $this->firebase->delete($this->defaultPath, [$id]);
        return true;
    }

    /**
     * @param Event $event
     * @return bool
     */
    public function addEvent(Event $event)
    {
        $seats = [];
        $capacity = $event->getCapacity();

        for ($count = 1; $count <= $capacity; $count++) {
            $seats[$count] = [
                'seatNumber' => $count,
                'status' => Seat::AVAILABLE,
            ];
        }

        $this->set($event->getId(), $seats);
        return true;
    }
}
