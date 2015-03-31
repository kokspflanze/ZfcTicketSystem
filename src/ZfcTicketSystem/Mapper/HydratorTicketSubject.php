<?php

namespace ZfcTicketSystem\Mapper;

use ZfcUser\Mapper\Exception;
use Zend\Stdlib\Hydrator\ClassMethods;
use ZfcTicketSystem\Entity\TicketSubject;

class HydratorTicketSubject extends ClassMethods {

	/**
	 * Extract values from an object
	 *
	 * @param  object $object
	 * @return array
	 * @throws Exception\InvalidArgumentException
	 */
	public function extract($object) {
		if (!$object instanceof TicketSubject) {
			throw new Exception\InvalidArgumentException('$object must be an instance of TicketSubject');
		}
		/* @var $object TicketSubject */
		$data = parent::extract($object);
		return $data;
	}

	/**
	 * Hydrate $object with the provided $data.
	 *
	 * @param  array $data
	 * @param  object $object
	 *
*@return TicketSubject
	 * @throws Exception\InvalidArgumentException
	 */
	public function hydrate(array $data, $object) {
		if (!$object instanceof TicketSubject) {
			throw new Exception\InvalidArgumentException('$object must be an instance of TicketSubject');
		}
		return parent::hydrate($data, $object);
	}
} 