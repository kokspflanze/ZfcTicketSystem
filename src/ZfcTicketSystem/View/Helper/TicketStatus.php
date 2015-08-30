<?php


namespace ZfcTicketSystem\View\Helper;


use ZfcTicketSystem\Entity\TicketSubject;

class TicketStatus extends InvokerBase
{
    /**
     * @param string $statusId
     * @return string
     */
    public function __invoke($statusId = null)
    {
        if (!is_scalar($statusId)) {
            $statusId = null;
        }
        $statusList = [
            TicketSubject::TYPE_NEW => 'new',
            TicketSubject::TYPE_OPEN => 'open',
            TicketSubject::TYPE_CLOSED => 'closed'
        ];

        return isset($statusList[$statusId]) ? $statusList[$statusId] : 'unknown';
    }

}