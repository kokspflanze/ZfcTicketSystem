<?php


namespace ZfcTicketSystem\Form;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TicketEntryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return TicketEntry
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $form = new TicketEntry();
        $form->setInputFilter(new TicketEntryFilter());

        return $form;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return TicketEntry
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, TicketEntry::class);
    }

}