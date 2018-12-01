<?php

namespace ZfcTicketSystem\Form;

use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

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
        $form->setInputFilter($container->get(InputFilterPluginManager::class)->get(AdminTicketCategoryFilter::class));

        return $form;
    }

}