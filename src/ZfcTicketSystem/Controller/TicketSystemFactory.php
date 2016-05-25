<?php


namespace ZfcTicketSystem\Controller;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcTicketSystem\Service\TicketSystem;

class TicketSystemFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return TicketSystemController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->getServiceLocator()->get('Config');
        /** @noinspection PhpParamsInspection */
        return new TicketSystemController(
            $serviceLocator->getServiceLocator()->get(TicketSystem::class),
            $serviceLocator->getServiceLocator()->get($config['zfc-ticket-system']['auth_service'])
        );
    }

}