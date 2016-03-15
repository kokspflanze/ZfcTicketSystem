<?php


namespace ZfcTicketSystemTest\View\Helper;


use ZfcTicketSystemTest\Util\TestBase;

class TicketStatusTest extends TestBase
{
    protected $className = 'ZfcTicketSystem\View\Helper\TicketStatus';

    public function testInvoke()
    {
        $this->assertContains('unknown', $this->getClass()->__invoke(-1));
        $this->assertContains('unknown', $this->getClass()->__invoke(['sdgdsg']));
        $this->assertNotContains('unknown', $this->getClass()->__invoke(1));
    }

    /**
     * @param null $className
     * @return \ZfcTicketSystem\View\Helper\TicketStatus
     */
    protected function getClass($className = null)
    {
        $class = new $this->className();

        return $class;
    }
}