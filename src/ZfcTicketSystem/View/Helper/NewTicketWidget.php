<?php


namespace ZfcTicketSystem\View\Helper;

class NewTicketWidget extends InvokerBase
{
    /**
     * @return int
     */
    public function __invoke()
    {
        return $this->getTicketService()->getNumberOfNewTickets();
    }

    /**
     * @return \ZfcTicketSystem\Service\TicketSystem
     */
    protected function getTicketService()
    {
        return $this->getServiceLocator()->get('zfcticketsystem_ticketsystem_service');
    }
}