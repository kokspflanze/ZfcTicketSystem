<?php

namespace ZfcTicketSystem\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class TicketSubject extends EntityRepository
{
    /**
     * @param $userId
     * @param int $limit
     * @return \ZfcTicketSystem\Entity\TicketSubject[]
     */
    public function getTicketList4UserId($userId, $limit = 0)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.user = :user')
            ->setParameter('user', $userId)
            ->orderBy('p.lastEdit', 'desc');

        if ($limit) {
            $query->setMaxResults($limit);
        }

        return $query->getQuery()->getResult();
    }

    /**
     * @param $ticketId
     *
     * @return \ZfcTicketSystem\Entity\TicketSubject|null
     */
    public function getTicketSubject4Admin($ticketId)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.id = :subjectTicketId')
            ->setParameter('subjectTicketId', $ticketId)
            ->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * @return \ZfcTicketSystem\Entity\TicketSubject|null
     */
    public function getTicket4UserId($userId, $ticketId)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.id = :subjectTicketId')
            ->setParameter('subjectTicketId', $ticketId)
            ->andWhere('p.user = :user')
            ->setParameter('user', $userId)
            ->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * @param string $type
     *
     * @return \ZfcTicketSystem\Entity\TicketSubject[]
     */
    public function getTickets4Type($type)
    {
        $query = $this->getQueryBuilder($type)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @return int
     */
    public function getNumberOfNewTickets()
    {
        $query = $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->where('p.type = :type')
            ->setParameter('type', \ZfcTicketSystem\Entity\TicketSubject::TYPE_NEW)
            ->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * @param string $type
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function getQueryBuilder($type)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.type = :type')
            ->setParameter('type', $type)
            ->orderBy('p.lastEdit', 'asc');
    }
} 