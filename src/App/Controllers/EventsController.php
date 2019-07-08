<?php

namespace App\Controllers;

class EventsController extends BaseController
{
    public function indexAction()
    {
        $eventsService = $this->factory->get('events');
        $list = $eventsService->getList();
        
        return [
            'status' => $eventsService->getStatus(),
            'data'   => $list,
        ];
    }

    public function addAction() 
    {
        $eventsService = $this->factory->get('events');
        $pars   = $this->getParameters();
        $data = $eventsService->add($pars);

        return [
            'status' => $eventsService->getStatus(),
            'data'   => $data,
        ];
    }

    public function updateAction() 
    {
        $eventsService = $this->factory->get('events');
        $pars = $this->getParameters();
        $data = $eventsService->update($pars);

        return [
            'status' => $eventsService->getStatus(),
            'data'   => $data,
        ];
    }

    public function deleteAction() 
    {
        $eventsService = $this->factory->get('events');
        $pars  = $this->getParameters();
        $data  = $eventsService->delete($pars['id']);

        return [
            'status' => $eventsService->getStatus(),
            'data'   => $data,
        ];
    }

    public function detailsAction()
    {
        $eventsService = $this->factory->get('events');
        $pars          = $this->getParametersRoute();
        $id        = isset($pars['par_1']) ? $pars['par_1'] : 0;
        $eventData = $eventsService->getEventData($id);

        return [
            'status' => $eventsService->getStatus(),
            'data'   => $eventData,
        ];
    }
}
