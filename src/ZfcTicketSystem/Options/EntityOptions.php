<?php
namespace ZfcTicketSystem\Options;

use Zend\Stdlib\AbstractOptions;


class EntityOptions extends AbstractOptions
{
    protected $__strictMode__ = false;

    /**
     * @var string
     */
    protected $ticketCategory = 'ZfcTicketSystem\Entity\Ticketcategory';

    /**
     * @var string
     */
    protected $ticketEntry = 'ZfcTicketSystem\Entity\Ticketentry';

    /**
     * @var string
     */
    protected $ticketSubject = 'ZfcTicketSystem\Entity\Ticketsubject';

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
    public function setTicketCategory( $ticketCategory )
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
    public function setTicketEntry( $ticketEntry )
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
    public function setTicketSubject( $ticketSubject )
    {
        $this->ticketSubject = $ticketSubject;
        return $this;
    }


}