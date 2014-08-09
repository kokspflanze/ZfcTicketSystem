<?php

namespace ZfcTicketSystem\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;

class FormWidget extends AbstractHelper {

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @param ServiceLocatorInterface $serviceLocatorInterface
     */
    public function __construct(ServiceLocatorInterface $serviceLocatorInterface){
        $this->setServiceLocator($serviceLocatorInterface);
    }

    public function __invoke($oForm){

        $oViewModel = new ViewModel(array(
			'formWidget' => $oForm
		));
        $oViewModel->setTemplate('helper/formWidget');

        return $this->getView()->render($oViewModel);
    }

    /**
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator(){
        return $this->serviceLocator;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return $this
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
        $this->serviceLocator = $serviceLocator;

        return $this;
    }
}