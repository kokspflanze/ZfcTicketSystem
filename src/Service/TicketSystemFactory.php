<?php

namespace ZfcTicketSystem\Service;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

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
            $container->get('FormElementManager')->get('zfcticketsystem_ticketsystem_new_form'),
            $container->get('FormElementManager')->get('zfcticketsystem_ticketsystem_entry_form'),
            $container->get('zfcticketsystem_entry_options')
        );
    }

}