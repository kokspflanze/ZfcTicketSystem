<?php

namespace ZfcTicketSystem\Form;

use ZfcBase\InputFilter\ProvidesEventsInputFilter;

class TicketEntryFilter extends ProvidesEventsInputFilter
{

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
                    ],
                ],
            ],
        ]);

    }

} 