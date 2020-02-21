<?php

namespace ZfcTicketSystem\Controller;

use ZfcTicketSystem\Entity\TicketSubject;

class AdminController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        $type = $this->params()->fromRoute('type');

        return [
            'ticketList' => $this->getTicketService()->getTickets4Type($type)
        ];
    }

    /**
     * @return array|\Laminas\Http\Response
     */
    public function viewAction()
    {
        $ticketId = $this->params()->fromRoute('id');
        $ticketSubject = $this->getTicketService()->getTicketSubject4Admin($ticketId);
        // Fallback if not task
        if (!$ticketSubject) {
            return $this->redirect()->toRoute('zfc-ticketsystem-admin', ['type' => TicketSubject::TYPE_NEW]);
        }

        $form = $this->getTicketService()->getTicketSystemEntryForm();

        /** @var \Laminas\Http\Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $ticketSubject->setType(TicketSubject::TYPE_OPEN);
            $ticketSystem = $this->getTicketService()->newAdminEntry(
                $this->params()->fromPost(),
                $this->getAuthService()->getIdentity(),
                $ticketSubject
            );

            if ($ticketSystem) {
                return $this->redirect()->toRoute('zfc-ticketsystem-admin', ['id' => $ticketId, 'action' => 'view']);
            }
        }

        $entry = $ticketSubject->getTicketEntry();

        return [
            'form' => $form,
            'ticket' => $ticketSubject,
            'entry' => $entry
        ];
    }

    /**
     * @return \Laminas\Http\Response
     */
    public function closeTicketAction()
    {
        $ticketId = $this->params()->fromRoute('id');
        $ticketSubject = $this->getTicketService()->getTicketSubject4Admin($ticketId);

        if ($ticketSubject) {
            $this->getTicketService()->closeTicket($ticketSubject);
        }

        return $this->redirect()->toRoute('zfc-ticketsystem-admin', ['type' => TicketSubject::TYPE_NEW]);
    }

} 