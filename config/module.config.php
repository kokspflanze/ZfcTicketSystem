<?php

namespace ZfcTicketSystem;

use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use ZfcTicketSystem\View\Helper;

return [
    'router' => [
        'routes' => [
            'zfc-ticketsystem' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/panel/ticket[-:action[-:id]].html',
                    'constraints' => [
                        'action' => '[a-zA-Z-]+',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\TicketSystemController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'zfc-ticketsystem-admin' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/admin/ticket[-:action[-:id]][-:type].html',
                    'constraints' => [
                        'action' => '[a-zA-Z-]+',
                        'id' => '[0-9]+',
                        'type' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
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
            'zfcticketsystem_entry_options' => Options\EntityOptions::class,
        ],
        'factories' => [
            Service\TicketSystem::class => Service\TicketSystemFactory::class,
            Service\Category::class => Service\CategoryFactory::class,
            Options\EntityOptions::class => Options\EntityFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\TicketSystemController::class => Controller\TicketSystemFactory::class,
            Controller\AdminController::class => Controller\AdminFactory::class,
        ],
    ],
    'form_elements' => [
        'aliases' => [
            'zfcticketsystem_ticketsystem_new_form' => Form\TicketSystem::class,
            'zfcticketsystem_ticketsystem_entry_form' => Form\TicketEntry::class,
            'zfcticketsystem_admin_category_form' => Form\AdminTicketCategory::class,
        ],
        'factories' => [
            Form\TicketSystem::class => Form\TicketSystemFactory::class,
            Form\TicketEntry::class => Form\TicketEntryFactory::class,
            Form\AdminTicketCategory::class => Form\AdminTicketCategoryFactory::class,
        ],
    ],
    'input_filters' => [
        'factories' => [
            Form\TicketSystemFilter::class => InvokableFactory::class,
            Form\TicketEntryFilter::class => InvokableFactory::class,
            Form\AdminTicketCategoryFilter::class => InvokableFactory::class,
        ],
    ],
    'doctrine' => [
        'driver' => [
            'application_entities' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
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
            'ticket_category' => Entity\TicketCategory::class,
            'ticket_entry' => Entity\TicketEntry::class,
            'ticket_subject' => Entity\TicketSubject::class,
            'user' => \SmallUser\Entity\User::class
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
