<?php


namespace ZfcTicketSystem\Form;

use Zend\Form;

class AdminTicketCategory extends Form\Form
{

    public function __construct()
    {
        parent::__construct();
        $this->add([
            'type' => Form\Element\Csrf::class,
            'name' => 'dfhs5ghrth3e4zn43ezj'
        ]);

        $this->add([
            'name' => 'subject',
            'options' => [
                'label' => 'Subject',
            ],
            'attributes' => [
                'placeholder' => 'Subject',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'sort_key',
            'options' => [
                'label' => 'Sortkey',
            ],
            'attributes' => [
                'placeholder' => 'Sortkey',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'active',
            'type' => Form\Element\Select::class,
            'options' => [
                'label' => 'Active',
                'value_options' => [
                    0 => 'deactive',
                    1 => 'active',
                ],
            ],
            'attributes' => [
                'placeholder' => 'Active',
                'class' => 'form-control',
            ],
        ]);

        $submitElement = new Form\Element\Button('submit');
        $submitElement
            ->setLabel('Submit')
            ->setAttributes([
                'class' => 'btn btn-default',
                'type' => 'submit',
            ]);

        $this->add($submitElement, [
            'priority' => -100,
        ]);
    }
}