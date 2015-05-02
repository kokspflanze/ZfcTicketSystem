<?php

namespace ZfcTicketSystem\Form;

use ZfcBase\InputFilter\ProvidesEventsInputFilter;
use Zend\ServiceManager\ServiceManager;

class TicketSystemFilter extends ProvidesEventsInputFilter
{
	/**
	 * @var ServiceManager
	 */
	protected $serviceManager;
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $entityManager;

	public function __construct( ServiceManager $serviceManager )
    {
		$this->setServiceManager($serviceManager);

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
			'validators' => array(
				array(
					'name'    => 'InArray',
					'options' => array(
						'haystack' => $this->getTicketCategory(),
					),
				),
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
	 * @param ServiceManager $serviceManager

	 * @return $this
	 */
	public function setServiceManager( ServiceManager $serviceManager )
    {
		$this->serviceManager = $serviceManager;

		return $this;
	}

	/**
	 * @return array
	 */
	protected function getTicketCategory()
    {
		/** @var \ZfcTicketSystem\Entity\Repository\TicketCategory $ticketCategory */
		$ticketCategory = $this->getEntityManager()->getRepository(
            $this->getServiceManager()->get( 'zfcticketsystem_entry_options' )->getTicketCategory()
        );

		$category = $ticketCategory->getActiveCategory();

		$result = array();
		foreach($category as $entry){
			$result[] = $entry->getId();
		}

		return $result;
	}

	/**
	 * @return ServiceManager
	 */
	protected function getServiceManager()
    {
		return $this->serviceManager;
	}
	/**
	 * @return \Doctrine\ORM\EntityManager
	 */
	protected function getEntityManager()
    {
		if (!$this->entityManager) {
			$this->entityManager = $this->getServiceManager()->get('Doctrine\ORM\EntityManager');
		}

		return $this->entityManager;
	}
} 