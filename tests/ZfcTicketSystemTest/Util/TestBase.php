<?php


namespace ZfcTicketSystemTest\Util;

use PHPUnit_Framework_TestCase as TestCase;

class TestBase extends TestCase
{
    /** @var  \Zend\ServiceManager\ServiceManager */
    protected $serviceManager;
    /** @var  string */
    protected $className;

    public function setUp()
    {
        parent::setUp();
        $this->serviceManager = ServiceManagerFactory::getServiceManager();
    }

    /**
     * @param $methodName
     * @return \ReflectionMethod
     */
    protected function getMethod($methodName) {
        $reflection = new \ReflectionClass($this->getClass());
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * @param null $className
     * @return object
     */
    protected function getClass( $className = null )
    {
        $class = $className?$className:$this->className;
        /** @var \Zend\ServiceManager\ServiceManagerAwareInterface $class */
        $class = new $class;
        $class->setServiceManager($this->serviceManager);

        return $class;
    }
}