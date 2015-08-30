<?php


namespace ZfcTicketSystemTest\View\Helper;


use ZfcTicketSystemTest\Util\TestBase;

class TicketStatusTest extends TestBase
{
    protected $className = 'ZfcTicketSystem\View\Helper\TicketStatus';

    public function testInvoke()
    {
        $this->assertContains('unknown', $this->getClass()->__invoke(-1));
        $this->assertContains('unknown', $this->getClass()->__invoke(array('sdgdsg')));
        $this->assertNotContains('unknown', $this->getClass()->__invoke(1));
    }

    /**
     * @param null $className
     * @return \ZfcTicketSystem\View\Helper\TicketStatus
     */
    protected function getClass($className = null)
    {
        /** @var \Zend\ServiceManager\ServiceManagerAwareInterface $class */
        $class = new $this->className($this->serviceManager);

        return $class;
    }
}