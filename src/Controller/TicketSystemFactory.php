<?php

namespace ZfcTicketSystem\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfcTicketSystem\Service\TicketSystem;

class TicketSystemFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return TicketSystemController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        /** @noinspection PhpParamsInspection */
        return new TicketSystemController(
            $container->get(TicketSystem::class),
            $container->get($config['zfc-ticket-system']['auth_service'])
        );
    }

}