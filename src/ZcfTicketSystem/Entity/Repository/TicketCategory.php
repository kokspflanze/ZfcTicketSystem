<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 07.08.14
 * Time: 22:57
 */

namespace ZfcTicketSystem\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class TicketCategory extends EntityRepository {
	/**
	 * @return \PServerCMS\Entity\Ticketcategory[]
	 */
	public function getActiveCategory(){
		$oQuery = $this->createQueryBuilder('p')
			->select('p')
			->where('p.active = :active')
			->setParameter('active', '1')
			->orderBy('p.sortkey','asc')
			->getQuery();
		return $oQuery->getResult();
	}
} 