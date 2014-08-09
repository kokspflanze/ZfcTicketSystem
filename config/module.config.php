<?php

return array(
	'router' => array(
		'routes' => array(
			'zfc-ticketsystem' => array(
				'type' => 'segment',
				'options' => array(
					'route'    => '/panel/ticket-system/[:action]',
					'constraints' => array(
						'action'     => '[a-zA-Z]+',
					),
					'defaults' => array(
						'controller'	=> 'ZfcTicketSystem\Controller\TicketSystem',
						'action'		=> 'index',
					),
				),
			),
			'zfc-ticketsystem-view' => array(
				'type' => 'segment',
				'options' => array(
					'route'    => '/panel/ticket-system/view/[:ticket-id].html',
					'constraints' => array(
						'ticket-id'     => '[0-9]+',
					),
					'defaults' => array(
						'controller'	=> 'ZfcTicketSystem\Controller\TicketSystem',
						'action'		=> 'view',
					),
				),
			),
		),
	),
	'controllers' => array(
		'invokables' => array(
			'ZfcTicketSystem\Controller\TicketSystem' => 'ZfcTicketSystem\Controller\TicketSystemController',
		),
	),
	'doctrine' => array(
		'driver' => array(
			'application_entities' => array(
				'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/ZfcTicketSystem/Entity')
			),
			'orm_default' => array(
				'drivers' => array(
					'ZfcTicketSystem\Entity' => 'application_entities'
				),
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
);
