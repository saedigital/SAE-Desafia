<?php

namespace Application\Form;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\GreaterThan;
use Zend\Validator\StringLength;

/**
 * Class EventFormFilter
 * @package Warehouse\Form
 */
class EventFormFilter implements InputFilterAwareInterface
{
    protected $inputFilter;
    
    /**
     * @param InputFilterInterface $inputFilter
     * @return void|InputFilterAwareInterface
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add([
                'name' => 'id',
                'required' => false,
                'filters' => [
                    ['name' => ToInt::class],
                ]
            ]);

            $inputFilter->add([
                'name' => 'name',
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ]);

            $inputFilter->add([
                'name' => 'description',
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1
                        ],
                    ],
                ],
            ]);

            $inputFilter->add([
                'name' => 'location',
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        ],
                    ],
                ],
            ]);

            $inputFilter->add([
                'name' => 'capacity',
                'required' => true,
                'filters' => [
                    ['name' => ToInt::class],
                ],
                'validators' => [
                    [
                        'name' => GreaterThan::class,
                        'options' => [
                            'min' => 0,
                            'messages' => [
                                'notGreaterThan' => 'Informe a capacidade do evento'
                            ]
                        ],
                    ],
                ],
            ]);

            $inputFilter->add([
                'name' => 'ticketAmount',
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        ],
                    ],
                ],
            ]);

            $inputFilter->add([
                'name' => 'showDate',
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        ],
                    ],
                ],
            ]);

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
