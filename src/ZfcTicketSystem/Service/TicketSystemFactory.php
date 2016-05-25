<?php


namespace ZfcTicketSystem\Service;


use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TicketSystemFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return TicketSystem
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @noinspection PhpParamsInspection */
        return new TicketSystem(
            $serviceLocator->get(EntityManager::class),
            $serviceLocator->get('zfcticketsystem_ticketsystem_new_form'),
            $serviceLocator->get('zfcticketsystem_ticketsystem_entry_form'),
            $serviceLocator->get('zfcticketsystem_entry_options')
        );
    }

}