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
	/** @var  \ZfcTicketSystem\Service\TicketSystem */
	protected $ticketService;
	protected $authService;
	protected $ticketEntryForm;

	public function indexAction(){
		return array('ticketList' => $this->getTicketService()->getTickets4User($this->getAuthService()->getIdentity()->getUsrid()));
	}

	public function newAction(){

		$form = $this->getTicketSystemNewForm();

		$oRequest = $this->getRequest();
		if($oRequest->isPost()){
			$oTicketSystem = $this->getTicketService()->newTicket($this->params()->fromPost(), $this->getAuthService()->getIdentity());
			if($oTicketSystem){
				return $this->redirect()->toRoute('zfc-ticketsystem');
			}
		}

		return array('form' => $form);
	}

	public function viewAction(){
		$ticketId = $this->params()->fromRoute('ticket-id');
		$ticketSubject = $this->getTicketService()->getTicketSubject($this->getAuthService()->getIdentity()->getUsrid(), $ticketId);
		// Fallback if not task
		if(!$ticketSubject){
			return $this->redirect()->toRoute('zfc-ticketsystem');
		}

		$form = $this->getTicketEntryForm();

		$oRequest = $this->getRequest();
		if($oRequest->isPost()){
			$oTicketSystem = $this->getTicketService()->newEntry($this->params()->fromPost(), $this->getAuthService()->getIdentity(), $ticketSubject);
			if($oTicketSystem){
				return $this->redirect()->toRoute('zfc-ticketsystem-view', array('ticket-id' => $ticketId));
			}
		}

		$entry = $ticketSubject->getTicketEntry();

		return array(
			'form' => $form,
			'ticket' => $ticketSubject,
			'entry' => $entry
		);
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

	/**
	 * @return \ZfcTicketSystem\Form\TicketEntry
	 */
	protected function getTicketEntryForm(){
		if (!$this->ticketEntryForm) {
			$this->ticketEntryForm = $this->getServiceLocator()->get('zfcticketsystem_ticketsystem_entry_form');
		}

		return $this->ticketEntryForm;
	}

	/**
	 * @return \ZfcTicketSystem\Service\TicketSystem
	 */
	protected function getTicketService(){
		if (!$this->ticketService) {
			$this->ticketService = $this->getServiceLocator()->get('zfcticketsystem_ticketsystem_service');
		}

		return $this->ticketService;
	}

	/**
	 * @return \Zend\Authentication\AuthenticationService
	 */
	protected function getAuthService() {
		if (!$this->authService) {
			$this->authService = $this->getServiceLocator()->get('user_auth_service');
		}

		return $this->authService;
	}
} 