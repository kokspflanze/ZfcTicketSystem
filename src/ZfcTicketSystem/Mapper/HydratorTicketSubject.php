<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 07.08.14
 * Time: 23:00
 */

namespace ZfcTicketSystem\Mapper;

use ZfcUser\Mapper\Exception;
use Zend\Stdlib\Hydrator\ClassMethods;
use ZfcTicketSystem\Entity\Ticketsubject;

class HydratorTicketSubject extends ClassMethods {

	/**
	 * Extract values from an object
	 *
	 * @param  object $object
	 * @return array
	 * @throws Exception\InvalidArgumentException
	 */
	public function extract($object) {
		if (!$object instanceof Ticketsubject) {
			throw new Exception\InvalidArgumentException('$object must be an instance of Ticketsubject');
		}
		/* @var $object Ticketsubject */
		$data = parent::extract($object);
		return $data;
	}

	/**
	 * Hydrate $object with the provided $data.
	 *
	 * @param  array $data
	 * @param  object $object
	 * @return Ticketsubject
	 * @throws Exception\InvalidArgumentException
	 */
	public function hydrate(array $data, $object) {
		if (!$object instanceof Ticketsubject) {
			throw new Exception\InvalidArgumentException('$object must be an instance of Ticketsubject');
		}
		return parent::hydrate($data, $object);
	}

	protected function mapField($keyFrom, $keyTo, array $aArray) {
		if(!isset($aArray[$keyFrom])){
			return $aArray;
		}
		$aArray[$keyTo] = $aArray[$keyFrom];
		unset($aArray[$keyFrom]);
		return $aArray;
	}
} 