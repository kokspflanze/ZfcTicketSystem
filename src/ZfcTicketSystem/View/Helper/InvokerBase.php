<?php

namespace ZfcTicketSystem\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

class InvokerBase extends AbstractHelper
{
    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    /**
     * @param ServiceLocatorInterface $serviceLocatorInterface
     */
    public function __construct( ServiceLocatorInterface $serviceLocatorInterface )
    {
        $this->setServiceLocator( $serviceLocatorInterface );
    }

    /**
     * @return ServiceLocatorInterface
     */
    protected function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return $this
     */
    protected function setServiceLocator( ServiceLocatorInterface $serviceLocator )
    {
        $this->serviceLocator = $serviceLocator;

        return $this;
    }

} 