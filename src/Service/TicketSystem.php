<?php

namespace ZfcTicketSystem\Service;

use Doctrine\ORM\EntityManager;
use SmallUser\Entity\UserInterface;
use ZfcTicketSystem\Entity\TicketSubject;
use ZfcTicketSystem\Form\TicketEntry;
use ZfcTicketSystem\Form\TicketSystem as FormTicketSystem;
use ZfcTicketSystem\Mapper\HydratorTicketEntry;
use ZfcTicketSystem\Mapper\HydratorTicketSubject;
use ZfcTicketSystem\Options\EntityOptions;

class TicketSystem
{
    /** @var EntityManager */
    protected $entityManager;
    /** @var FormTicketSystem */
    protected $ticketSystemNewForm;
    /** @var TicketEntry */
    protected $ticketSystemEntryForm;
    /** @var  EntityOptions */
    protected $entityOptions;

    /**
     * TicketSystem constructor.
     * @param EntityManager $entityManager
     * @param FormTicketSystem $ticketSystemNewForm
     * @param TicketEntry $ticketSystemEntryForm
     * @param EntityOptions $entityOptions
     */
    public function __construct(
        EntityManager $entityManager,
        FormTicketSystem $ticketSystemNewForm,
        TicketEntry $ticketSystemEntryForm,
        EntityOptions $entityOptions
    ) {
        $this->entityManager = $entityManager;
        $this->ticketSystemNewForm = $ticketSystemNewForm;
        $this->ticketSystemEntryForm = $ticketSystemEntryForm;
        $this->entityOptions = $entityOptions;
    }

    /**
     * @param array $data
     * @param UserInterface $user
     * @return bool|TicketSubject
     */
    public function newTicket(array $data, UserInterface $user)
    {
        $form = $this->getTicketSystemNewForm();
        $form->setHydrator(new HydratorTicketSubject());
        $class = $this->getEntityOptions()->getTicketSubject();
        $form->bind(new $class());
        $form->setData($data);

        if (!$form->isValid()) {
            return false;
        }

        /** @var TicketSubject $ticketSubject */
        $ticketSubject = $form->getData();
        $ticketCategory = $this->getTicketCategory4Id($data['categoryId']);

        if ($ticketCategory) {
            $ticketSubject->setTicketCategory($ticketCategory);
        }

        $entityManager = $this->getEntityManager();
        $ticketSubject->setUser($this->getUser4Id($user->getId()));
        $entityManager->persist($ticketSubject);
        $entityManager->flush();

        $this->newEntry($data, $ticketSubject->getUser(), $ticketSubject);

        return $ticketSubject;
    }

    /**
     * @param array $data
     * @param UserInterface $user
     * @param TicketSubject $subject
     * @return bool|\ZfcTicketSystem\Entity\TicketEntry
     */
    public function newEntry(array $data, UserInterface $user, TicketSubject $subject)
    {
        $form = $this->getTicketSystemEntryForm();
        $form->setHydrator(new HydratorTicketEntry());
        $class = $this->getEntityOptions()->getTicketEntry();
        $form->bind(new $class());
        $form->setData($data);
        if (!$form->isValid()) {
            return false;
        }
        /** @var \ZfcTicketSystem\Entity\TicketEntry $ticketEntry */
        $ticketEntry = $form->getData();
        $ticketEntry->setSubject($subject);
        $ticketEntry->setUser($this->getUser4Id($user->getId()));
        $subject->addTicketEntry($ticketEntry);

        $subject->setLastEdit(new \DateTime());

        $entityManager = $this->getEntityManager();
        $entityManager->persist($ticketEntry);
        $entityManager->persist($subject);
        $entityManager->flush();

        return $ticketEntry;
    }

    /**
     * @param array $data
     * @param UserInterface $user
     * @param TicketSubject $subject
     * @return bool|\ZfcTicketSystem\Entity\TicketEntry
     */
    public function newAdminEntry(array $data, UserInterface $user, TicketSubject $subject)
    {
        return $this->newEntry($data, $user, $subject);
    }

    /**
     * @param TicketSubject $ticketSubject
     * @return TicketSubject
     */
    public function closeTicket($ticketSubject)
    {
        $ticketSubject->setType(TicketSubject::TYPE_CLOSED);

        $entityManager = $this->getEntityManager();
        $entityManager->persist($ticketSubject);
        $entityManager->flush();

        return $ticketSubject;
    }

    /**
     * @param $userId
     * @param int $limit
     * @return null|\ZfcTicketSystem\Entity\TicketSubject[]
     */
    public function getTickets4User($userId, $limit = 0)
    {
        $entityManager = $this->getEntityManager();
        /** @var \ZfcTicketSystem\Entity\Repository\TicketSubject $repository */
        $repository = $entityManager->getRepository($this->getEntityOptions()->getTicketSubject());

        return $repository->getTicketList4UserId($userId, $limit);
    }

    /**
     * @param $userId
     * @param $ticketId
     * @return TicketSubject
     */
    public function getTicketSubject($userId, $ticketId)
    {
        $entityManager = $this->getEntityManager();
        /** @var \ZfcTicketSystem\Entity\Repository\TicketSubject $repository */
        $repository = $entityManager->getRepository($this->getEntityOptions()->getTicketSubject());

        return $repository->getTicket4UserId($userId, $ticketId);
    }

    /**
     * @param $ticketId
     * @return TicketSubject
     */
    public function getTicketSubject4Admin($ticketId)
    {
        $entityManager = $this->getEntityManager();
        /** @var \ZfcTicketSystem\Entity\Repository\TicketSubject $repository */
        $repository = $entityManager->getRepository($this->getEntityOptions()->getTicketSubject());

        return $repository->getTicketSubject4Admin($ticketId);
    }

    /**
     * @param $type
     * @return TicketSubject[]
     */
    public function getTickets4Type($type)
    {
        $entityManager = $this->getEntityManager();
        /** @var \ZfcTicketSystem\Entity\Repository\TicketSubject $repository */
        $repository = $entityManager->getRepository($this->getEntityOptions()->getTicketSubject());

        return $repository->getTickets4Type($type);
    }

    /**
     * @return int
     */
    public function getNumberOfNewTickets()
    {
        /** @var \ZfcTicketSystem\Entity\Repository\TicketSubject $repository */
        $repository = $this->getEntityManager()->getRepository($this->getEntityOptions()->getTicketSubject());

        return $repository->getNumberOfNewTickets();
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @return EntityOptions
     */
    public function getEntityOptions()
    {
        return $this->entityOptions;
    }

    /**
     * @return FormTicketSystem
     */
    public function getTicketSystemNewForm()
    {
        return $this->ticketSystemNewForm;
    }

    /**
     * @return TicketEntry
     */
    public function getTicketSystemEntryForm()
    {
        return $this->ticketSystemEntryForm;
    }

    /**
     * @param $userId
     * @return null|UserInterface
     */
    protected function getUser4Id($userId)
    {
        /** @var \SmallUser\Entity\Repository\User $repository */
        $repository = $this->getEntityManager()->getRepository($this->getEntityOptions()->getUser());

        return $repository->getUser4Id($userId);
    }

    /**
     * @param $categoryId
     * @return null|\ZfcTicketSystem\Entity\TicketCategory
     */
    protected function getTicketCategory4Id($categoryId)
    {
        /** @var \ZfcTicketSystem\Entity\Repository\TicketCategory $entityManager */
        $entityManager = $this->getEntityManager()->getRepository($this->getEntityOptions()->getTicketCategory());

        return $entityManager->getCategory($categoryId);
    }

} 