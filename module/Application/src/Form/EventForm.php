<?php

namespace Application\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Number;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

/**
 * Class EventForm
 * @package Application\Form
 */
class EventForm extends Form
{
    public function __construct($name = 'event')
    {
        parent::__construct($name);

        $this->setAttribute('role', 'form');

        $inputFilter = new EventFormFilter();
        $this->setInputFilter($inputFilter->getInputFilter());

        $this->add([
            'name' => 'id',
            'type' => Hidden::class
        ]);

        $this->add([
            'name' => 'csrf',
            'type' => Csrf::class
        ]);

        $this->add([
            'name' => 'name',
            'type' => Text::class,
            'options' => [
                'label' => 'Nome do evento'
            ],
            'attributes' => [
                'class' => 'form-control',
                'id' => 'name',
                'required' => true
            ]
        ]);

        $this->add([
            'name' => 'description',
            'type' => Textarea::class,
            'options' => [
                'label' => 'Descrição'
            ],
            'attributes' => [
                'class' => 'form-control',
                'id' => 'description',
                'required' => true
            ]
        ]);

        $this->add([
            'name' => 'location',
            'type' => Text::class,
            'options' => [
                'label' => 'Local'
            ],
            'attributes' => [
                'class' => 'form-control',
                'id' => 'location',
                'required' => true
            ]
        ]);

        $this->add([
            'name' => 'capacity',
            'type' => Number::class,
            'options' => [
                'label' => 'Capacidade'
            ],
            'attributes' => [
                'class' => 'form-control',
                'id' => 'capacity',
                'required' => true
            ]
        ]);

        $this->add([
            'name' => 'ticketAmount',
            'type' => Text::class,
            'options' => [
                'label' => 'Valor do ingresso'
            ],
            'attributes' => [
                'class' => 'form-control price',
                'id' => 'ticketAmount',
                'placeholder' => 'R$ ',
                'autocomplete' => 'Off',
                'required' => true
            ]
        ]);

        $this->add([
            'name' => 'showDate',
            'type' => Text::class,
            'options' => [
                'label' => 'Data do evento'
            ],
            'attributes' => [
                'class' => 'form-control datetimepicker',
                'id' => 'showDate',
                'placeholder' => 'dd/mm/aaaa HH:ss',
                'autocomplete' => 'Off',
                'required' => true
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'options' => [
                'label_options' => [
                    'disable_html_escape' => true,
                ],
                'label' => '&nbsp;'
            ],
            'attributes' => [
                'value' => 'Gravar',
                'class' => 'btn btn-primary btn-block'
            ]
        ]);
    }
}
