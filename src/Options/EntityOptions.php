<?php
namespace ZfcTicketSystem\Options;

use SmallUser\Entity as SmallUserEntity;
use Zend\Stdlib\AbstractOptions;
use ZfcTicketSystem\Entity;

class EntityOptions extends AbstractOptions
{
    protected $__strictMode__ = false;

    /**
     * @var string
     */
    protected $ticketCategory = Entity\TicketCategory::class;

    /**
     * @var string
     */
    protected $ticketEntry = Entity\TicketEntry::class;

    /**
     * @var string
     */
    protected $ticketSubject = Entity\TicketSubject::class;

    /**
     * @var string
     */
    protected $user = SmallUserEntity\User::class;

    /**
     * @return string
     */
    public function getTicketCategory()
    {
        return $this->ticketCategory;
    }

    /**
     * @param string $ticketCategory
     *
     * @return EntityOptions
     */
    public function setTicketCategory($ticketCategory)
    {
        $this->ticketCategory = $ticketCategory;
        return $this;
    }

    /**
     * @return string
     */
    public function getTicketEntry()
    {
        return $this->ticketEntry;
    }

    /**
     * @param string $ticketEntry
     *
     * @return EntityOptions
     */
    public function setTicketEntry($ticketEntry)
    {
        $this->ticketEntry = $ticketEntry;
        return $this;
    }

    /**
     * @return string
     */
    public function getTicketSubject()
    {
        return $this->ticketSubject;
    }

    /**
     * @param string $ticketSubject
     *
     * @return EntityOptions
     */
    public function setTicketSubject($ticketSubject)
    {
        $this->ticketSubject = $ticketSubject;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return EntityOptions
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

}