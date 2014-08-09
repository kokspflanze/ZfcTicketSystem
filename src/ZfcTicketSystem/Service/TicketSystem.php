<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 04.08.14
 * Time: 22:41
 */

namespace ZfcTicketSystem\Service;

use PServerCMS\Entity\Users;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use ZfcTicketSystem\Entity\Ticketentry;
use ZfcTicketSystem\Entity\Ticketsubject;
use ZfcTicketSystem\Entity\Ticketcategory;
use ZfcTicketSystem\Mapper\HydratorTicketEntry;
use ZfcTicketSystem\Mapper\HydratorTicketSubject;

class TicketSystem implements ServiceManagerAwareInterface {
	/** @var ServiceManager */
	protected $serviceManager;
	/** @var \Doctrine\ORM\EntityManager */
	protected $entityManager;
	protected $ticketSystemNewForm;
	protected $ticketSystemEntryForm;

	public function newTicket( array $data, Users $user ){
		$form = $this->getTicketSystemNewForm();
		$form->setHydrator(new HydratorTicketSubject());
		$form->bind(new Ticketsubject());
		$form->setData($data);
		if(!$form->isValid()){
			return false;
		}
		/** @var \ZfcTicketSystem\Entity\Ticketsubject $ticketSubject */
		$ticketSubject = $form->getData();
		$ticketCategory = $this->getTicketCategory4Id($data['categoryId']);
		if($ticketCategory){
			$ticketSubject->setTicketcategoryCategoryid($ticketCategory);
		}
		$entityManager = $this->getEntityManager();
		$ticketSubject->setUsersUsrid($this->getUser4Id($user->getUsrid()));
		$entityManager->persist($ticketSubject);
		$entityManager->flush();

		$this->newEntry($data, $ticketSubject->getUsersUsrid(), $ticketSubject);

		return $ticketSubject;
	}

	public function newEntry( array $data, Users $user, Ticketsubject $subject ){
		$form = $this->getTicketSystemEntryForm();
		$form->setHydrator(new HydratorTicketEntry());
		$form->bind(new Ticketentry());
		$form->setData($data);
		if(!$form->isValid()){
			return false;
		}
		/** @var \ZfcTicketSystem\Entity\Ticketentry $ticketEntry */
		$ticketEntry = $form->getData();
		$ticketEntry->setSubject($subject);
		$ticketEntry->setUsersUsrid($this->getUser4Id($user->getUsrid()));
		$subject->addTicketEntry($ticketEntry);

		$entityManager = $this->getEntityManager();
		$entityManager->persist($ticketEntry);
		$entityManager->persist($subject);
		$entityManager->flush();

		return $ticketEntry;
	}

	/**
	 * @param $userId
	 *
	 * @return \ZfcTicketSystem\Entity\TicketSubject[]|null
	 */
	public function getTickets4User( $userId ){
		$entityManager = $this->getEntityManager();
		/** @var \ZfcTicketSystem\Entity\Repository\TicketSubject $repository */
		$repository = $entityManager->getRepository('\ZfcTicketSystem\Entity\Ticketsubject');
		return $repository->getTicketList4UserId($userId);
	}

	/**
	 * @param $userId
	 * @param $ticketId
	 *
	 * @return TicketSubject
	 */
	public function getTicketSubject( $userId, $ticketId ){
		$entityManager = $this->getEntityManager();
		/** @var \ZfcTicketSystem\Entity\Repository\TicketSubject $repository */
		$repository = $entityManager->getRepository('\ZfcTicketSystem\Entity\Ticketsubject');
		return $repository->getTicket4UserId($userId, $ticketId);
	}

	/**
	 * @return ServiceManager
	 */
	public function getServiceManager() {
		return $this->serviceManager;
	}

	/**
	 * @param ServiceManager $oServiceManager
	 *
	 * @return $this
	 */
	public function setServiceManager( ServiceManager $oServiceManager ) {
		$this->serviceManager = $oServiceManager;

		return $this;
	}

	/**
	 * @param $userId
	 *
	 * @return null|\PServerCMS\Entity\Users
	 */
	protected function getUser4Id( $userId ){
		$entityManager = $this->getEntityManager();
		return $entityManager->getRepository('PServerCMS\Entity\Users')->findOneBy(array('usrid' => $userId));
	}

	/**
	 * @param $categoryId
	 *
	 * @return null|\ZfcTicketSystem\Entity\Ticketcategory
	 */
	protected function getTicketCategory4Id($categoryId){
		$entityManager = $this->getEntityManager();
		return $entityManager->getRepository('ZfcTicketSystem\Entity\Ticketcategory')->findOneBy(array('categoryid' => $categoryId, 'active' => '1'));
	}

	/**
	 * @return \Doctrine\ORM\EntityManager
	 */
	public function getEntityManager() {
		if (!$this->entityManager) {
			$this->entityManager = $this->getServiceManager()->get('Doctrine\ORM\EntityManager');
		}

		return $this->entityManager;
	}

	/**
	 * @return \ZfcTicketSystem\Form\TicketSystem
	 */
	protected function getTicketSystemNewForm(){
		if (!$this->ticketSystemNewForm) {
			$this->ticketSystemNewForm = $this->getServiceManager()->get('zfcticketsystem_ticketsystem_new_form');
		}

		return $this->ticketSystemNewForm;
	}

	/**
	 * @return \ZfcTicketSystem\Form\TicketEntry
	 */
	protected function getTicketSystemEntryForm(){
		if (!$this->ticketSystemEntryForm) {
			$this->ticketSystemEntryForm = $this->getServiceManager()->get('zfcticketsystem_ticketsystem_entry_form');
		}

		return $this->ticketSystemEntryForm;
	}

} 