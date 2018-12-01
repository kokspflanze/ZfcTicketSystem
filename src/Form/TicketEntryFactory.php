<?php

namespace ZfcTicketSystem\Form;

use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

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
        $form->setInputFilter($container->get(InputFilterPluginManager::class)->get(TicketEntryFilter::class));

        return $form;
    }
}