<?php


namespace ZfcTicketSystem\Controller;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcTicketSystem\Service\TicketSystem;

class TicketSystemFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        /** @noinspection PhpParamsInspection */
        return new TicketSystemController(
            $container->get(TicketSystem::class),
            $container->get($config['zfc-ticket-system']['auth_service'])
        );
    }

    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return TicketSystemController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator->getServiceLocator(), TicketSystemController::class);
    }

}