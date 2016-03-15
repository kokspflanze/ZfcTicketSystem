<?php

namespace ZfcTicketSystem\Form;

use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class TicketEntry extends ProvidesEventsForm
{

    public function __construct()
    {
        parent::__construct();
        $this->add([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'fdh456eh56ujzum45zkuik45zhrh'
        ]);

        $this->add([
            'name' => 'memo',
            'type' => 'Zend\Form\Element\Textarea',
            'options' => [
                'label' => 'Memo',
            ],
            'attributes' => [
                'placeholder' => 'Memo',
                'class' => 'form-control',
            ],
        ]);

        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('Submit')
            ->setAttributes([
                'class' => 'btn btn-primary',
                'type' => 'submit',
            ]);

        $this->add($submitElement, [
            'priority' => -100,
        ]);
    }
} 