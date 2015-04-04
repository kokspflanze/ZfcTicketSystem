<?php

namespace ZfcTicketSystem\Controller;

use ZfcTicketSystem\Entity\TicketSubject;

class AdminController extends BaseController
{

    public function indexAction()
    {
        $type = $this->params()->fromRoute( 'type' );

        return array(
            'ticketList' => $this->getTicketService()->getTickets4Type( $type )
        );
    }

    public function viewAction()
    {
        $ticketId      = $this->params()->fromRoute( 'id' );
        $ticketSubject = $this->getTicketService()->getTicketSubject4Admin( $ticketId );
        // Fallback if not task
        if (!$ticketSubject) {
            return $this->redirect()->toRoute( 'zfc-ticketsystem-admin', array( 'type' => 0 ) );
        }

        $form = $this->getTicketService()->getTicketSystemEntryForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $ticketSubject->setType( TicketSubject::TYPE_OPEN );
            $oTicketSystem = $this->getTicketService()->newEntry( $this->params()->fromPost(), $this->getAuthService()->getIdentity(),
                $ticketSubject );
            if ($oTicketSystem) {
                return $this->redirect()->toRoute( 'zfc-ticketsystem-admin', array( 'id' => $ticketId, 'action' => 'view' ) );
            }
        }

        $entry = $ticketSubject->getTicketEntry();

        return array(
            'form'   => $form,
            'ticket' => $ticketSubject,
            'entry'  => $entry
        );
    }

} 