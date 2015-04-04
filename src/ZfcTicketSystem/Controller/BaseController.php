<?php

namespace ZfcTicketSystem\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class BaseController extends AbstractActionController
{
    /** @var \ZfcTicketSystem\Service\TicketSystem */
    protected $ticketService;
    /** @var \Zend\Authentication\AuthenticationService */
    protected $authService;

    /**
     * @return \ZfcTicketSystem\Service\TicketSystem
     */
    protected function getTicketService()
    {
        if (!$this->ticketService) {
            $this->ticketService = $this->getServiceLocator()->get( 'zfcticketsystem_ticketsystem_service' );
        }

        return $this->ticketService;
    }

    /**
     * @return \Zend\Authentication\AuthenticationService
     */
    protected function getAuthService()
    {
        if (!$this->authService) {
            $config            = $this->getServiceLocator()->get( 'Config' );
            $this->authService = $this->getServiceLocator()->get( $config['zfc-ticket-system']['auth_service'] );
        }

        return $this->authService;
    }
} 