<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 07.08.14
 * Time: 23:40
 */

namespace ZfcTicketSystem\Form;

use ZfcBase\InputFilter\ProvidesEventsInputFilter;

class TicketEntryFilter extends ProvidesEventsInputFilter {

	public function __construct( ){
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

} 