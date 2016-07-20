<?php


namespace ZfcTicketSystem\Service;


use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TicketSystemFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return TicketSystem
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @noinspection PhpParamsInspection */
        return new TicketSystem(
            $container->get(EntityManager::class),
            $container->get('zfcticketsystem_ticketsystem_new_form'),
            $container->get('zfcticketsystem_ticketsystem_entry_form'),
            $container->get('zfcticketsystem_entry_options')
        );
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return TicketSystem
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @noinspection PhpParamsInspection */
        return $this($serviceLocator, TicketSystem::class);
    }

}