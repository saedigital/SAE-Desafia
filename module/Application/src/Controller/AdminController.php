<?php

namespace Application\Controller;

use Application\Entity\Event;

/**
 * Class AdminController
 * @package Application\Controller
 */
class AdminController extends CrudController
{
    public function __construct()
    {
        $this->service = EventService::class;
        $this->form = EventForm::class;
        $this->redirectTo = 'admin-event';
        $this->repository = Event::class;
    }
}
