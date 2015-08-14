<?php

namespace ZfcTicketSystem\Form;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Form;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class TicketSystem extends ProvidesEventsForm
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function __construct( ServiceLocatorInterface $serviceLocator )
    {
        parent::__construct();
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'fdh456eh56ujzum45zkuik45zhrh'
        ));

        $this->add(array(
            'name' => 'subject',
            'options' => array(
                'label' => 'Subject',
            ),
            'attributes' => array(
                'placeholder' => 'Subject',
                'class' => 'form-control',
                'type' => 'text'
            ),
        ));
        $this->add(array(
            'name' => 'categoryId',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'object_manager'=> $serviceLocator->get( 'Doctrine\ORM\EntityManager' ),
                'target_class'  => $serviceLocator->get( 'zfcticketsystem_entry_options' )->getTicketCategory(),
                'property'		=> 'subject',
                'label'			=> 'Category',
                'empty_option'  => '-- select --',
                'is_method'		=> true,
                'find_method'	=> array(
                    'name' => 'getActiveCategory',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'memo',
            'type' => 'Zend\Form\Element\Textarea',
            'options' => array(
                'label' => 'Memo',
            ),
            'attributes' => array(
                'placeholder' => 'Memo',
                'class' => 'form-control',
            ),
        ));

        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('Submit')
            ->setAttributes(array(
                'class' => 'btn btn-primary',
                'type'  => 'submit',
            ));

        $this->add($submitElement, array(
            'priority' => -100,
        ));
    }
}