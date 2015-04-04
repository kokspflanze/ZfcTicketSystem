<?php

namespace ZfcTicketSystem\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class TicketEntry extends ProvidesEventsForm
{

	public function __construct()
    {
		parent::__construct();
		$this->add(array(
			'type' => 'Zend\Form\Element\Csrf',
			'name' => 'fdh456eh56ujzum45zkuik45zhrh'
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