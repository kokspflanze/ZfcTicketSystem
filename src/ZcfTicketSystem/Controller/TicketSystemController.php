<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 07.08.14
 * Time: 18:26
 */

namespace ZfcTicketSystem\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class TicketSystemController extends AbstractActionController {
	/** @var \ZfcTicketSystem\Form\TicketSystem */
	protected $ticketSystemNewForm;

	public function indexAction(){

	}

	public function newAction(){
		return array('form' => $this->getTicketSystemNewForm());
	}

	public function detailAction(){

	}

	/**
	 * @return \ZfcTicketSystem\Form\TicketSystem
	 */
	protected function getTicketSystemNewForm(){
		if (!$this->ticketSystemNewForm) {
			$this->ticketSystemNewForm = $this->getServiceLocator()->get('zfcticketsystem_ticketsystem_new_form');
		}

		return $this->ticketSystemNewForm;
	}
} 