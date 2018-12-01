<?php

namespace ZfcTicketSystem\Form;

use Zend\Filter;
use Zend\InputFilter\InputFilter;
use Zend\Validator;

class TicketEntryFilter extends InputFilter
{
    public function init(): void
    {
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