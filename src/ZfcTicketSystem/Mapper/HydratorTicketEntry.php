<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 07.08.14
 * Time: 23:53
 */

namespace ZfcTicketSystem\Mapper;

use ZfcUser\Mapper\Exception;
use Zend\Stdlib\Hydrator\ClassMethods;
use ZfcTicketSystem\Entity\Ticketentry;


class HydratorTicketEntry extends ClassMethods {

	/**
	 * Extract values from an object
	 *
	 * @param  object $object
	 * @return array
	 * @throws Exception\InvalidArgumentException
	 */
	public function extract($object) {
		if (!$object instanceof Ticketentry) {
			throw new Exception\InvalidArgumentException('$object must be an instance of Ticketentry');
		}
		/* @var $object Ticketentry */
		$data = parent::extract($object);
		return $data;
	}

	/**
	 * Hydrate $object with the provided $data.
	 *
	 * @param  array $data
	 * @param  object $object
	 * @return Ticketentry
	 * @throws Exception\InvalidArgumentException
	 */
	public function hydrate(array $data, $object) {
		if (!$object instanceof Ticketentry) {
			throw new Exception\InvalidArgumentException('$object must be an instance of Ticketentry');
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