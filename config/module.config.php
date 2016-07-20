<?php

use Zend\ServiceManager\Factory\InvokableFactory;
use ZfcTicketSystem\Controller;
use ZfcTicketSystem\Form;
use ZfcTicketSystem\Options;
use ZfcTicketSystem\View\Helper;
use ZfcTicketSystem\Service;

return [
    'router' => [
        'routes' => [
            'zfc-ticketsystem' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/panel/ticket[-:action[-:id]].html',
                    'constraints' => [
                        'action' => '[a-zA-Z-]+',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'ZfcTicketSystem\Controller\TicketSystem',
                        'action' => 'index',
                    ],
                ],
            ],
            'zfc-ticketsystem-admin' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/admin/ticket[-:action[-:id]][-:type].html',
                    'constraints' => [
                        'action' => '[a-zA-Z-]+',
                        'id' => '[0-9]+',
                        'type' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'ZfcTicketSystem\Controller\Admin',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'zfcticketsystem_ticketsystem_service' => Service\TicketSystem::class,
            'zfcticketsystem_category_service' => Service\Category::class,
            'zfcticketsystem_ticketsystem_new_form' => Form\TicketSystem::class,
            'zfcticketsystem_ticketsystem_entry_form' => Form\TicketEntry::class,
            'zfcticketsystem_admin_category_form' => Form\AdminTicketCategory::class,
            'zfcticketsystem_entry_options' => Options\EntityOptions::class,
        ],
        'factories' => [
            Service\TicketSystem::class => Service\TicketSystemFactory::class,
            Service\Category::class => Service\CategoryFactory::class,
            Form\TicketSystem::class => Form\TicketSystemFactory::class,
            Form\TicketEntry::class => Form\TicketEntryFactory::class,
            Form\AdminTicketCategory::class => Form\AdminTicketCategoryFactory::class,
            Options\EntityOptions::class => Options\EntityFactory::class,
        ],
    ],
    'controllers' => [
        'aliases' => [
            'ZfcTicketSystem\Controller\TicketSystem' => Controller\TicketSystemController::class,
            'ZfcTicketSystem\Controller\Admin' => Controller\AdminController::class,
        ],
        'factories' => [
            Controller\TicketSystemController::class => Controller\TicketSystemFactory::class,
            Controller\AdminController::class => Controller\AdminFactory::class,
        ],
    ],
    'doctrine' => [
        'driver' => [
            'application_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/ZfcTicketSystem/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    'ZfcTicketSystem\Entity' => 'application_entities'
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'zfc-ticket-system/new' => __DIR__ . '/../view/zfc-ticket-system/ticket-system/new.phtml',
            'zfc-ticket-system/view' => __DIR__ . '/../view/zfc-ticket-system/ticket-system/view.phtml',
            'zfc-ticket-system/index' => __DIR__ . '/../view/zfc-ticket-system/ticket-system/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'zfc-ticket-system' => [
        'auth_service' => 'user_auth_service',
        'entity' => [
            'ticket_category' => 'ZfcTicketSystem\Entity\TicketCategory',
            'ticket_entry' => 'ZfcTicketSystem\Entity\TicketEntry',
            'ticket_subject' => 'ZfcTicketSystem\Entity\TicketSubject',
            'user' => 'SmallUser\Entity\User'
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'numberOfNewTickets' => Helper\NewTicketWidget::class,
            'ticketStatus' => Helper\TicketStatus::class,
        ],
        'factories' => [
            Helper\NewTicketWidget::class => Helper\NewTicketFactory::class,
            Helper\TicketStatus::class => InvokableFactory::class,
        ],
    ],
];
