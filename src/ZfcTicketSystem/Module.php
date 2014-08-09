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
		return include __DIR__ . '/../../config/module.config.php';
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
						/** @var $oRepositoryCategory \Doctrine\Common\Persistence\ObjectRepository */
						$oRepositoryCategory = $sm->get('Doctrine\ORM\EntityManager')->getRepository('ZfcTicketSystem\Entity\Ticketcategory');
						$form = new Form\TicketSystem($sm->get('Doctrine\ORM\EntityManager'));
						$form->setInputFilter(new Form\TicketSystemFilter(
							// TODO remove pServerCMS
							new \PServerCMS\Validator\RecordExists( $oRepositoryCategory, 'categoryId' )
						));
						return $form;
					},
				'zfcticketsystem_ticketsystem_entry_form' => function($sm){
						/** @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
						/** @var $oRepositoryCategory \Doctrine\Common\Persistence\ObjectRepository */
						$form = new Form\TicketEntry();
						$form->setInputFilter(new Form\TicketEntryFilter());
						return $form;
					}
			),
		);
	}
}