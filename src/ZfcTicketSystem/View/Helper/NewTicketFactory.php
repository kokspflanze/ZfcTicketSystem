<?php


namespace ZfcTicketSystem\View\Helper;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NewTicketFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return NewTicketWidget
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {/** @noinspection PhpParamsInspection */
        return new NewTicketWidget(
            $container->get('zfcticketsystem_ticketsystem_service')
        );
    }

    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return NewTicketWidget
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator->getServiceLocator(), NewTicketWidget::class);
    }

}