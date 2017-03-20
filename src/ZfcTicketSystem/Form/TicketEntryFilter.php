<?php

namespace ZfcTicketSystem\Form;

use Zend\InputFilter\InputFilter;

class TicketEntryFilter extends InputFilter
{
    /**
     * TicketEntryFilter constructor.
     */
    public function __construct()
    {
        $this->add([
            'name' => 'memo',
            'required' => true,
            'filters' => [['name' => 'StringTrim']],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 3,
                        'max' => 65535,
                    ],
                ],
            ],
        ]);

    }

} 