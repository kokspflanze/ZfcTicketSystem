<?php


namespace ZfcTicketSystem\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfcTicketSystem\Service\TicketSystem;

class AdminFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AdminController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        /** @noinspection PhpParamsInspection */
        return new AdminController(
            $container->get(TicketSystem::class),
            $container->get($config['zfc-ticket-system']['auth_service'])
        );
    }

}