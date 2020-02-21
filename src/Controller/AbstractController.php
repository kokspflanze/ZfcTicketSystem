<?php

namespace ZfcTicketSystem\Controller;

use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Controller\AbstractActionController;
use ZfcTicketSystem\Service\TicketSystem;

class AbstractController extends AbstractActionController
{
    /** @var TicketSystem */
    protected $ticketService;
    /** @var AuthenticationService */
    protected $authService;

    /**
     * AbstractController constructor.
     * @param TicketSystem $ticketService
     * @param AuthenticationService $authService
     */
    public function __construct(TicketSystem $ticketService, AuthenticationService $authService)
    {
        $this->ticketService = $ticketService;
        $this->authService = $authService;
    }

    /**
     * @return TicketSystem
     */
    protected function getTicketService()
    {
        return $this->ticketService;
    }

    /**
     * @return AuthenticationService
     */
    protected function getAuthService()
    {
        return $this->authService;
    }
} 