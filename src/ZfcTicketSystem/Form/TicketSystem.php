<?php

namespace ZfcTicketSystem\Form;

use Doctrine\ORM\EntityManager;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;
use ZfcTicketSystem\Options\EntityOptions;

class TicketSystem extends ProvidesEventsForm
{
    /**
     * TicketSystem constructor.
     * @param EntityManager $entityManager
     * @param EntityOptions $entityOptions
     */
    public function __construct(EntityManager $entityManager, EntityOptions $entityOptions)
    {
        parent::__construct();

        $this->add([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'fdh456eh56ujzum45zkuik45zhrh'
        ]);

        $this->add([
            'name' => 'subject',
            'options' => [
                'label' => 'Subject',
            ],
            'attributes' => [
                'placeholder' => 'Subject',
                'class' => 'form-control',
                'type' => 'text'
            ],
        ]);
        $this->add([
            'name' => 'categoryId',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => [
                'object_manager' => $entityManager,
                'target_class' => $entityOptions->getTicketCategory(),
                'property' => 'subject',
                'label' => 'Category',
                'empty_option' => '-- select --',
                'is_method' => true,
                'find_method' => [
                    'name' => 'getActiveCategory',
                ],
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
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