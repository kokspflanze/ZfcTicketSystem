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
		$query = $this->createQueryBuilder('p')
			->select('p')
			->where('p.active = :active')
			->setParameter('active', '1')
			->orderBy('p.sortKey','asc')
			->getQuery();

		return $query->getResult();
	}

    /**
     * @param $id
     * @return \ZfcTicketSystem\Entity\TicketCategory|null
     */
    public function getCategory( $id )
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.active = :active')
            ->setParameter('active', '1')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getOneOrNullResult();
    }
} 