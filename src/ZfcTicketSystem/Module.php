<?php

namespace ZfcTicketSystem;

use Zend\ServiceManager\AbstractPluginManager;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    public function getViewHelperConfig()
    {
        return [
            'factories' => [
                'numberOfNewTickets' => function (AbstractPluginManager $pluginManager) {
                    /** @noinspection PhpParamsInspection */
                    return new View\Helper\NewTicketWidget(
                        $pluginManager->getServiceLocator()->get('zfcticketsystem_ticketsystem_service')
                    );
                },
                'ticketStatus' => function () {
                    return new View\Helper\TicketStatus();
                },
            ]
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'zfcticketsystem_ticketsystem_new_form' => function ($sm) {
                    /** @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
                    /** @noinspection PhpParamsInspection */
                    $form = new Form\TicketSystem(
                        $sm->get('Doctrine\ORM\EntityManager'),
                        $sm->get('zfcticketsystem_entry_options')
                    );

                    /** @noinspection PhpParamsInspection */
                    $form->setInputFilter(
                        new Form\TicketSystemFilter(
                            $sm->get('Doctrine\ORM\EntityManager'),
                            $sm->get('zfcticketsystem_entry_options')
                        )
                    );

                    return $form;
                },
                'zfcticketsystem_ticketsystem_entry_form' => function () {
                    $form = new Form\TicketEntry();
                    $form->setInputFilter(new Form\TicketEntryFilter());
                    return $form;
                },
                'zfcticketsystem_admin_category_form' => function () {
                    $form = new Form\AdminTicketCategory();
                    $form->setInputFilter(new Form\AdminTicketCategoryFilter());
                    return $form;
                },
                'zfcticketsystem_entry_options' => function ($sm) {
                    /** @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
                    $config = $sm->get('Configuration');
                    return new Options\EntityOptions($config['zfc-ticket-system']['entity']);
                }
            ],
        ];
    }
}