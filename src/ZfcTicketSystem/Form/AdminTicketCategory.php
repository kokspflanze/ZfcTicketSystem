<?php


namespace ZfcTicketSystem\Form;

use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class AdminTicketCategory extends ProvidesEventsForm
{

    public function __construct()
    {
        parent::__construct();
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'dfhs5ghrth3e4zn43ezj'
        ));

        $this->add(array(
            'name' => 'subject',
            'options' => array(
                'label' => 'Subject',
            ),
            'attributes' => array(
                'placeholder' => 'Subject',
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'sortkey',
            'options' => array(
                'label' => 'Sortkey',
            ),
            'attributes' => array(
                'placeholder' => 'Sortkey',
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'active',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Active',
                'value_options' => array(
                    0 => 'deactive',
                    1 => 'active',
                ),
            ),
            'attributes' => array(
                'placeholder' => 'Active',
                'class' => 'form-control',
            ),
        ));

        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('Submit')
            ->setAttributes(array(
                'class' => 'btn btn-default',
                'type' => 'submit',
            ));

        $this->add($submitElement, array(
            'priority' => -100,
        ));
    }
}