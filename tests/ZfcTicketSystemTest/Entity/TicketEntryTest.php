<?php


namespace ZfcTicketSystemTest\Entity;


use SmallUser\Entity\User;
use ZfcTicketSystem\Entity\TicketEntry;
use ZfcTicketSystem\Entity\TicketSubject;

class TicketEntryTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $entity = new TicketEntry();

        $this->assertInstanceOf('DateTime', $entity->getCreated());
    }

    public function testId()
    {
        $entity = new TicketEntry();
        $id = rand(0,99999);
        $result = $entity->setId($id);

        $this->assertEquals($entity, $result);
        $this->assertEquals($id, $result->getId());
    }

    public function testMemo()
    {
        $entity = new TicketEntry();
        $memo = 'foobar';
        $result = $entity->setMemo($memo);

        $this->assertEquals($entity, $result);
        $this->assertEquals($memo, $result->getMemo());
    }

    public function testUser()
    {
        $entity = new TicketEntry();
        $user = new User();
        $result = $entity->setUser($user);

        $this->assertEquals($entity, $result);
        $this->assertEquals($user, $result->getUser());
    }

    public function testSubject()
    {
        $entity = new TicketEntry();
        $subject = new TicketSubject();
        $result = $entity->setSubject($subject);

        $this->assertEquals($entity, $result);
        $this->assertEquals($subject, $result->getSubject());
    }

    public function testCreated()
    {
        $entity = new TicketEntry();
        $dateTime = new \DateTime();
        $result = $entity->setCreated($dateTime);

        $this->assertEquals($entity, $result);
        $this->assertEquals($dateTime, $result->getCreated());
    }
}
