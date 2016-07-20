<?php


namespace ZfcTicketSystem\Service;


use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Category
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @noinspection PhpParamsInspection */
        return new Category(
            $container->get('zfcticketsystem_admin_category_form'),
            $container->get(EntityManager::class),
            $container->get('zfcticketsystem_entry_options')
        );
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return Category
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @noinspection PhpParamsInspection */
        return $this($serviceLocator, Category::class);
    }

}