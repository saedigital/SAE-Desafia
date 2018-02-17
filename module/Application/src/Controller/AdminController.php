<?php

namespace Application\Controller;

use Application\Entity\Event;
use Application\Form\EventForm;
use Application\Service\EventService;
use DateTime;

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
        $this->redirectMethod = 'toRoute';
        $this->entity = Event::class;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function bindDataToForm($data)
    {
        $data['showDate'] = $data['showDate']->format('d/m/Y H:i');
        $data['ticketAmount'] = 'R$ ' . number_format($data['ticketAmount'], 2, ',', '.');

        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function bindDataToService($data)
    {
        if (isset($data['id']) && $data['id'] == 0) {
            unset($data['id']);
        }

        $data['ticketAmount'] = (float)str_replace(['R$ ', '.', ','], ['', '', '.'], $data['ticketAmount']);
        $data['showDate'] = new DateTime(str_replace('/', '-', $data['showDate']));

        return $data;
    }
}
