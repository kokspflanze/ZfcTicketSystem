<?php

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
        ],
        'factories' => [
            Service\TicketSystem::class => function($sm) {
                /** @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
                /** @noinspection PhpParamsInspection */
                return new Service\TicketSystem(
                    $sm->get('Doctrine\ORM\EntityManager'),
                    $sm->get('zfcticketsystem_ticketsystem_new_form'),
                    $sm->get('zfcticketsystem_ticketsystem_entry_form'),
                    $sm->get('zfcticketsystem_entry_options')
                );
            },
            Service\Category::class => function($sm) {
                /** @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
                /** @noinspection PhpParamsInspection */
                return new Service\Category(
                    $sm->get('zfcticketsystem_admin_category_form'),
                    $sm->get('Doctrine\ORM\EntityManager'),
                    $sm->get('zfcticketsystem_entry_options')
                );
            }
        ],
    ],
    'controllers' => [
        'invokables' => [
            'ZfcTicketSystem\Controller\TicketSystem' => 'ZfcTicketSystem\Controller\TicketSystemController',
            'ZfcTicketSystem\Controller\Admin' => 'ZfcTicketSystem\Controller\AdminController',
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
];
