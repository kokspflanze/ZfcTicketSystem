<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 07.08.14
 * Time: 22:57
 */

namespace ZfcTicketSystem\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class TicketSubject extends EntityRepository {
	/**
	 * @return \ZfcTicketSystem\Entity\TicketSubject[]
	 */
	public function getTicketList4UserId($userId){
		$query = $this->createQueryBuilder('p')
			->select('p')
			->where('p.usersUsrid = :usersUsrid')
			->setParameter('usersUsrid', $userId)
			->orderBy('p.created','desc')
			->getQuery();
		return $query->getResult();
	}
	/**
	 * @return \ZfcTicketSystem\Entity\TicketSubject
	 */
	public function getTicket4UserId($userId, $ticketId){
		$query = $this->createQueryBuilder('p')
			->select('p')
			->where('p.ticketid = :subjectTicketId')
			->setParameter('subjectTicketId', $ticketId)
			->andWhere('p.usersUsrid = :usersUsrid')
			->setParameter('usersUsrid', $userId)
			->getQuery();
		return $query->getOneOrNullResult();
	}
} 