<?php


namespace ZfcTicketSystem\Controller;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcTicketSystem\Service\TicketSystem;

class AdminFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return AdminController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->getServiceLocator()->get('Config');
        /** @noinspection PhpParamsInspection */
        return new AdminController(
            $serviceLocator->getServiceLocator()->get(TicketSystem::class),
            $serviceLocator->getServiceLocator()->get($config['zfc-ticket-system']['auth_service'])
        );
    }

}