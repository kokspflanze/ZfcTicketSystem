<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 07.08.14
 * Time: 18:36
 */

namespace ZfcTicketSystem;

class Module {
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	/**
	 * Expected to return \Zend\ServiceManager\Config object or array to
	 * seed such an object.
	 *
	 * @return array|\Zend\ServiceManager\Config
	 */
	public function getServiceConfig() {
		return array(
			'invokables' => array(
				'zfcticketsystem_ticketsystem_service'		=> 'ZfcTicketSystem\Service\TicketSystem',
			),
			'factories' => array(
				'zfcticketsystem_ticketsystem_new_form' => function($sm){
					/** @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
					$form = new Form\TicketSystem($sm->get('Doctrine\ORM\EntityManager'));
					$form->setInputFilter(new Form\TicketSystemFilter());
					return $form;
				}
			),
		);
	}
} 