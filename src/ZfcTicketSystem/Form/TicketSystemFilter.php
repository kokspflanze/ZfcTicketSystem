<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 04.08.14
 * Time: 22:43
 */

namespace ZfcTicketSystem\Form;

use ZfcBase\InputFilter\ProvidesEventsInputFilter;
use PServerCMS\Validator\AbstractRecord;

class TicketSystemFilter extends ProvidesEventsInputFilter {

	/**
	 * @var AbstractRecord
	 */
	protected $usernameValidator;


	public function __construct( AbstractRecord $ticketCategoryValidator ){
		$this->setTicketCategoryValidator( $ticketCategoryValidator );

		$this->add(array(
			'name'       => 'subject',
			'required'   => true,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'min' => 3,
						'max' => 255,
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'categoryId',
			'required'   => true,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				$this->getTicketCategoryValidator(),
			),
		));

		$this->add(array(
			'name'       => 'memo',
			'required'   => true,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'min' => 3,
					),
				),
			),
		));

	}

	/**
	 * @return AbstractRecord
	 */
	public function getTicketCategoryValidator()	{
		return $this->usernameValidator;
	}

	/**
	 * @param AbstractRecord $usernameValidator
	 *
	 * @return $this
	 */
	public function setTicketCategoryValidator($usernameValidator) {
		$this->usernameValidator = $usernameValidator;
		return $this;
	}
} 