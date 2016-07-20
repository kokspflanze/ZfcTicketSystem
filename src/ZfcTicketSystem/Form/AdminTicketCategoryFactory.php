<?php


namespace ZfcTicketSystem\Form;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AdminTicketCategoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AdminTicketCategory
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $form = new AdminTicketCategory();
        $form->setInputFilter(new AdminTicketCategoryFilter());

        return $form;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return AdminTicketCategory
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, AdminTicketCategory::class);
    }

}