<?php


namespace ZfcTicketSystem\Form;


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
        $form = new TicketSystem(
            $container->get(EntityManager::class),
            $container->get('zfcticketsystem_entry_options')
        );

        /** @noinspection PhpParamsInspection */
        $form->setInputFilter(
            new TicketSystemFilter(
                $container->get(EntityManager::class),
                $container->get('zfcticketsystem_entry_options')
            )
        );

        return $form;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return TicketSystem
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, TicketSystem::class);
    }

}