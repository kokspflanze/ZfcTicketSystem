<?php

namespace ZfcTicketSystem\Service;

use SmallUser\Entity\UserInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use ZfcTicketSystem\Mapper\HydratorTicketEntry;
use ZfcTicketSystem\Mapper\HydratorTicketSubject;
use ZfcTicketSystem\Entity\TicketSubject;

class TicketSystem implements ServiceManagerAwareInterface
{
    /** @var ServiceManager */
    protected $serviceManager;
    /** @var \Doctrine\ORM\EntityManager */
    protected $entityManager;
    /** @var \ZfcTicketSystem\Form\TicketSystem */
    protected $ticketSystemNewForm;
    /** @var \ZfcTicketSystem\Form\TicketEntry */
    protected $ticketSystemEntryForm;
    /** @var  \ZfcTicketSystem\Options\EntityOptions */
    protected $entityOptions;

    /**
     * @param array         $data
     * @param UserInterface $user
     * @return bool|TicketSubject
     */
    public function newTicket( array $data, UserInterface $user )
    {
        $form = $this->getTicketSystemNewForm();
        $form->setHydrator( new HydratorTicketSubject() );
        $class = $this->getEntityOptions()->getTicketSubject();
        $form->bind( new $class() );
        $form->setData( $data );

        if (!$form->isValid()) {
            return false;
        }

        /** @var TicketSubject $ticketSubject */
        $ticketSubject  = $form->getData();
        $ticketCategory = $this->getTicketCategory4Id( $data['categoryId'] );

        if ($ticketCategory) {
            $ticketSubject->setTicketCategory( $ticketCategory );
        }

        $entityManager = $this->getEntityManager();
        $ticketSubject->setUser( $this->getUser4Id( $user->getId() ) );
        $entityManager->persist( $ticketSubject );
        $entityManager->flush();

        $this->newEntry( $data, $ticketSubject->getUser(), $ticketSubject );

        return $ticketSubject;
    }

    /**
     * @param array         $data
     * @param UserInterface $user
     * @param TicketSubject $subject
     * @return bool|\ZfcTicketSystem\Entity\TicketEntry
     */
    public function newEntry( array $data, UserInterface $user, TicketSubject $subject )
    {
        $form = $this->getTicketSystemEntryForm();
        $form->setHydrator( new HydratorTicketEntry() );
        $class = $this->getEntityOptions()->getTicketEntry();
        $form->bind( new $class() );
        $form->setData( $data );
        if (!$form->isValid()) {
            return false;
        }
        /** @var \ZfcTicketSystem\Entity\TicketEntry $ticketEntry */
        $ticketEntry = $form->getData();
        $ticketEntry->setSubject( $subject );
        $ticketEntry->setUser( $this->getUser4Id( $user->getId() ) );
        $subject->addTicketEntry( $ticketEntry );

        $subject->setLastEdit( new \DateTime() );

        $entityManager = $this->getEntityManager();
        $entityManager->persist( $ticketEntry );
        $entityManager->persist( $subject );
        $entityManager->flush();

        return $ticketEntry;
    }

    /**
     * @param TicketSubject $ticketSubject
     * @return TicketSubject
     */
    public function closeTicket($ticketSubject)
    {
        $ticketSubject->setType(TicketSubject::TYPE_CLOSED);

        $entityManager = $this->getEntityManager();
        $entityManager->persist( $ticketSubject );
        $entityManager->flush();

        return $ticketSubject;
    }

    /**
     * @param $userId
     * @return TicketSubject[]|null
     */
    public function getTickets4User( $userId )
    {
        $entityManager = $this->getEntityManager();
        /** @var \ZfcTicketSystem\Entity\Repository\TicketSubject $repository */
        $repository = $entityManager->getRepository( $this->getEntityOptions()->getTicketSubject() );

        return $repository->getTicketList4UserId( $userId );
    }

    /**
     * @param $userId
     * @param $ticketId
     * @return TicketSubject
     */
    public function getTicketSubject( $userId, $ticketId )
    {
        $entityManager = $this->getEntityManager();
        /** @var \ZfcTicketSystem\Entity\Repository\TicketSubject $repository */
        $repository = $entityManager->getRepository( $this->getEntityOptions()->getTicketSubject() );

        return $repository->getTicket4UserId( $userId, $ticketId );
    }

    /**
     * @param $ticketId
     * @return TicketSubject
     */
    public function getTicketSubject4Admin( $ticketId )
    {
        $entityManager = $this->getEntityManager();
        /** @var \ZfcTicketSystem\Entity\Repository\TicketSubject $repository */
        $repository = $entityManager->getRepository( $this->getEntityOptions()->getTicketSubject() );

        return $repository->getTicketSubject4Admin( $ticketId );
    }

    /**
     * @param $type
     * @return TicketSubject[]
     */
    public function getTickets4Type( $type )
    {
        $entityManager = $this->getEntityManager();
        /** @var \ZfcTicketSystem\Entity\Repository\TicketSubject $repository */
        $repository = $entityManager->getRepository( $this->getEntityOptions()->getTicketSubject() );

        return $repository->getTickets4Type( $type );
    }

    /**
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
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
     * @return \ZfcTicketSystem\Form\TicketSystem
     */
    public function getTicketSystemNewForm()
    {
        if (!$this->ticketSystemNewForm) {
            $this->ticketSystemNewForm = $this->getServiceManager()->get( 'zfcticketsystem_ticketsystem_new_form' );
        }

        return $this->ticketSystemNewForm;
    }

    /**
     * @return \ZfcTicketSystem\Form\TicketEntry
     */
    public function getTicketSystemEntryForm()
    {
        if (!$this->ticketSystemEntryForm) {
            $this->ticketSystemEntryForm = $this->getServiceManager()->get( 'zfcticketsystem_ticketsystem_entry_form' );
        }

        return $this->ticketSystemEntryForm;
    }

    /**
     * @return int
     */
    public function getNumberOfNewTickets()
    {
        /** @var \ZfcTicketSystem\Entity\Repository\TicketSubject $repository */
        $repository = $this->getEntityManager()->getRepository( $this->getEntityOptions()->getTicketSubject() );

        return $repository->getNumberOfNewTickets();
    }

    /**
     * @param $userId
     * @return null|UserInterface
     */
    protected function getUser4Id( $userId )
    {
        /** @var \SmallUser\Entity\Repository\User $repository */
        $repository = $this->getEntityManager()->getRepository( $this->getEntityOptions()->getUser() );

        return $repository->getUser4Id( $userId );
    }

    /**
     * @param $categoryId
     * @return null|\ZfcTicketSystem\Entity\TicketCategory
     */
    protected function getTicketCategory4Id( $categoryId )
    {
        /** @var \ZfcTicketSystem\Entity\Repository\TicketCategory $entityManager */
        $entityManager = $this->getEntityManager()->getRepository( $this->getEntityOptions()->getTicketCategory() );

        return $entityManager->getCategory( $categoryId );
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (!$this->entityManager) {
            $this->entityManager = $this->getServiceManager()->get( 'Doctrine\ORM\EntityManager' );
        }

        return $this->entityManager;
    }

    /**
     * @return \ZfcTicketSystem\Options\EntityOptions
     */
    public function getEntityOptions()
    {
        if (!$this->entityOptions) {
            $this->entityOptions = $this->getServiceManager()->get( 'zfcticketsystem_entry_options' );
        }

        return $this->entityOptions;
    }

} 