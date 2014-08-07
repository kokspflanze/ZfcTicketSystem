<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 04.08.14
 * Time: 22:43
 */

namespace ZfcTicketSystem\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;
use Doctrine\ORM\EntityManager;

class TicketSystem extends ProvidesEventsForm {

	public function __construct( EntityManager $entityManager ) {
		parent::__construct();
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
			'name' => 'subject',
			'type' => 'DoctrineModule\Form\Element\ObjectSelect',
			'options' => array(
				'object_manager'=> $entityManager,
				'target_class'  => 'PServerCMS\Entity\Ticketcategory',
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
			->setLabel('Register')
			->setAttributes(array(
				'class' => 'btn btn-primary',
				'type'  => 'submit',
			));

		$this->add($submitElement, array(
			'priority' => -100,
		));
	}
}