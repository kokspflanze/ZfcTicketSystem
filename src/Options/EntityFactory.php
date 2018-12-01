<?php

namespace ZfcTicketSystem\Options;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class EntityFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return EntityOptions
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new EntityOptions($container->get('config')['zfc-ticket-system']['entity']);
    }

}