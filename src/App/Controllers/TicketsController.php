<?php

namespace App\Controllers;

class TicketsController extends BaseController
{
    public function bookingAction()
    {
        $ticketsService = $this->factory->get('tickets');
        $pars = $this->getParameters();
        $eventId = $pars['event_id'];
        $booking = explode(',', $pars['books']);
        $eventData = $ticketsService->bookingEvent($eventId, $booking);
        
        return [
            'status' => $ticketsService->getStatus(),
            'data'   => $eventData,
        ];
    }

    public function eventAction()
    {
        $ticketsService = $this->factory->get('tickets');
        $pars = $this->getParametersRoute();
        $id   = isset($pars['par_1']) ? $pars['par_1'] : 0;
        $eventData = $ticketsService->dataEvent($id);
        
        return [
            'status' => $ticketsService->getStatus(),
            'data'   => $eventData,
        ];
    }

    public function cancelAction()
    {
        $ticketsService = $this->factory->get('tickets');
        $pars = $this->getParametersRoute();
        $ticketId  = isset($pars['par_1']) ? $pars['par_1'] : 0;
        $eventData = $ticketsService->cancelBookingEvent($ticketId);
        
        return [
            'status' => $ticketsService->getStatus(),
            'data'   => $eventData,
        ];
    }
    
    public function listAction()
    {
        $ticketsService = $this->factory->get('tickets');
        $list = $ticketsService->getList();

        return [
            'status' => $ticketsService->getStatus(),
            'data'   => $list,
        ];
    }

    public function truncateAction()
    {
        $ticketsService = $this->factory->get('tickets');
        $ticketsService->truncate();
        return [];
    }
}
