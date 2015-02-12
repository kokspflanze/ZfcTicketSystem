<?php

namespace ZfcTicketSystem\Controller;

use Zend\View\Model\ViewModel;
use ZfcTicketSystem\Entity\Ticketsubject;

class TicketSystemController extends BaseController {

	public function indexAction(){
		$view = new ViewModel(array(
			'ticketList' => $this->getTicketService()->getTickets4User($this->getAuthService()->getIdentity()->getUsrid())
		));
		$view->setTemplate('zfc-ticket-system/index');
		return $view;
	}

	public function newAction(){

		$form = $this->getTicketService()->getTicketSystemNewForm();

		$request = $this->getRequest();
		if($request->isPost()){
			$ticketSystem = $this->getTicketService()->newTicket($this->params()->fromPost(), $this->getAuthService()->getIdentity());
			if($ticketSystem){
				return $this->redirect()->toRoute('zfc-ticketsystem');
			}
		}
		$view = new ViewModel(array('form' => $form));
		$view->setTemplate('zfc-ticket-system/new');

		return $view;
	}

	public function viewAction(){
		$ticketId = $this->params()->fromRoute('id');
		$ticketSubject = $this->getTicketService()->getTicketSubject($this->getAuthService()->getIdentity()->getId(), $ticketId);
		// Fallback if not task
		if(!$ticketSubject){
			return $this->redirect()->toRoute('zfc-ticketsystem');
		}

		$form = $this->getTicketService()->getTicketSystemEntryForm();

		$request = $this->getRequest();
		if($request->isPost()){
			$ticketSubject->setType(Ticketsubject::TypeNew);
			$ticketSystem = $this->getTicketService()->newEntry($this->params()->fromPost(), $this->getAuthService()->getIdentity(), $ticketSubject);
			if($ticketSystem){
				return $this->redirect()->toRoute('zfc-ticketsystem', array('id' => $ticketId, 'action' => 'view'));
			}
		}

		$entry = $ticketSubject->getTicketEntry();

		$view = new ViewModel(array(
			'form' => $form,
			'ticket' => $ticketSubject,
			'entry' => $entry
		));
		$view->setTemplate('zfc-ticket-system/view');

		return $view;
	}

} 