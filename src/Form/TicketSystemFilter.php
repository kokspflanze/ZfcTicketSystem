<?php

namespace ZfcTicketSystem\Form;

use Laminas\Filter;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator;

class TicketSystemFilter extends InputFilter
{
    public function init(): void
    {
        $this->add([
            'name' => 'subject',
            'required' => true,
            'filters' => [
                ['name' => Filter\StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => Validator\StringLength::class,
                    'options' => [
                        'min' => 3,
                        'max' => 255,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'categoryId',
            'required' => true
        ]);

        $this->add([
            'name' => 'memo',
            'required' => true,
            'filters' => [
                ['name' => Filter\StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => Validator\StringLength::class,
                    'options' => [
                        'min' => 3,
                        'max' => 65535,
                    ],
                ],
            ],
        ]);
    }
} 