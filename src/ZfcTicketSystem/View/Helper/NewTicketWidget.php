<?php


namespace ZfcTicketSystem\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZfcTicketSystem\Service\TicketSystem;

class NewTicketWidget extends AbstractHelper
{
    /** @var  TicketSystem */
    protected $ticketService;

    /**
     * NewTicketWidget constructor.
     * @param TicketSystem $ticketService
     */
    public function __construct(TicketSystem $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * @return int
     */
    public function __invoke()
    {
        return $this->ticketService->getNumberOfNewTickets();
    }


}