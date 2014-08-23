<?php

return array(
	'router' => array(
		'routes' => array(
			'zfc-ticketsystem' => array(
				'type' => 'segment',
				'options' => array(
					'route'    => '/panel/ticket[-:action[-:id]].html',
					'constraints' => array(
						'action'     => '[a-zA-Z]+',
						'id'	     => '[0-9]+',
					),
					'defaults' => array(
						'controller'	=> 'ZfcTicketSystem\Controller\TicketSystem',
						'action'		=> 'index',
					),
				),
			),
			'zfc-ticketsystem-admin' => array(
				'type' => 'segment',
				'options' => array(
					'route'    => '/admin/ticket[-:action[-:id]][-:type].html',
					'constraints' => array(
						'action'     => '[a-zA-Z]+',
						'id'    	 => '[0-9]+',
						'type'    	 => '[0-9]+',
					),
					'defaults' => array(
						'controller'	=> 'ZfcTicketSystem\Controller\Admin',
						'action'		=> 'index',
					),
				),
			),
		),
	),
	'controllers' => array(
		'invokables' => array(
			'ZfcTicketSystem\Controller\TicketSystem' => 'ZfcTicketSystem\Controller\TicketSystemController',
			'ZfcTicketSystem\Controller\Admin' => 'ZfcTicketSystem\Controller\AdminController',
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
		'template_map' => array(
			'zfc-ticket-system/new'		=> __DIR__ . '/../view/zfc-ticket-system/ticket-system/new.phtml',
			'zfc-ticket-system/view'	=> __DIR__ . '/../view/zfc-ticket-system/ticket-system/view.phtml',
			'zfc-ticket-system/index'	=> __DIR__ . '/../view/zfc-ticket-system/ticket-system/index.phtml',
		),
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
	'zfc-ticket-system' => array(
		'auth_service' => 'user_auth_service',
	)
);
