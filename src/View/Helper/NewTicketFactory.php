<?php

namespace ZfcTicketSystem\View\Helper;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

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

}