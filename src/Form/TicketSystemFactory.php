<?php

namespace ZfcTicketSystem\Form;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

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
        $form = new TicketSystem(
            $container->get(EntityManager::class),
            $container->get('zfcticketsystem_entry_options')
        );

        $form->setInputFilter(
            $container->get(InputFilterPluginManager::class)->get(TicketSystemFilter::class)
        );

        return $form;
    }

}