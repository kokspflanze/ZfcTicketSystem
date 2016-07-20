<?php


namespace ZfcTicketSystem\View\Helper;


use Zend\View\Helper\AbstractHelper;
use ZfcTicketSystem\Entity\TicketSubject;

class TicketStatus extends AbstractHelper
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