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
            ->orderBy('p.sortKey', 'asc')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param $id
     * @return \ZfcTicketSystem\Entity\TicketCategory|null
     */
    public function getCategory($id)
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

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->createQueryBuilder('p')
            ->select('p');
    }

    /**
     * @param $categoryId
     * @return null|\ZfcTicketSystem\Entity\TicketCategory
     */
    public function getCategory4Id($categoryId)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.id = :categoryId')
            ->setParameter('categoryId', $categoryId)
            ->getQuery();

        return $query->getOneOrNullResult();
    }
} 