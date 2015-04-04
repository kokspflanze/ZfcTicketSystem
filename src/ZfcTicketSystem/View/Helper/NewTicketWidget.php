<?php


namespace ZfcTicketSystem\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

class NewTicketWidget extends AbstractHelper
{
    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    /**
     * @param ServiceLocatorInterface $serviceLocatorInterface
     */
    public function __construct( ServiceLocatorInterface $serviceLocatorInterface )
    {
        $this->setServiceLocator( $serviceLocatorInterface );
    }

    /**
     * @return ServiceLocatorInterface
     */
    protected function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return $this
     */
    protected function setServiceLocator( ServiceLocatorInterface $serviceLocator )
    {
        $this->serviceLocator = $serviceLocator;

        return $this;
    }

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
        return $this->getServiceLocator()->get( 'zfcticketsystem_ticketsystem_service' );
    }
}