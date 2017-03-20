<?php


namespace ZfcTicketSystemTest\Util;

use PHPUnit\Framework\TestCase;

class TestBase extends TestCase
{
    /** @var  string */
    protected $className;

    /**
     * @param $methodName
     * @return \ReflectionMethod
     */
    protected function getMethod($methodName)
    {
        $reflection = new \ReflectionClass($this->getClass());
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * @param null $className
     * @return object
     */
    protected function getClass($className = null)
    {
        $class = $className ? $className : $this->className;
        $class = new $class;

        return $class;
    }
}