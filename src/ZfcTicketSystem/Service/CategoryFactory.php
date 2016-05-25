<?php


namespace ZfcTicketSystem\Service;


use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategoryFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @noinspection PhpParamsInspection */
        return new Category(
            $serviceLocator->get('zfcticketsystem_admin_category_form'),
            $serviceLocator->get(EntityManager::class),
            $serviceLocator->get('zfcticketsystem_entry_options')
        );
    }

}