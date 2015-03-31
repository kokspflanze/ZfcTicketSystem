<?php

namespace ZfcTicketSystem\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class TicketCategory extends EntityRepository
{
	/**
	 * @return \ZfcTicketSystem\Entity\TicketCategory[]
	 */
	public function getActiveCategory()
    {
		$oQuery = $this->createQueryBuilder('p')
			->select('p')
			->where('p.active = :active')
			->setParameter('active', '1')
			->orderBy('p.sortKey','asc')
			->getQuery();
		return $oQuery->getResult();
	}
} 