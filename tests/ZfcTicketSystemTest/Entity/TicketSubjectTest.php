<?php


namespace ZfcTicketSystemTest\Entity;


use PHPUnit\Framework\TestCase;
use SmallUser\Entity\User;
use ZfcTicketSystem\Entity\TicketCategory;
use ZfcTicketSystem\Entity\TicketEntry;
use ZfcTicketSystem\Entity\TicketSubject;

class TicketSubjectTest extends TestCase
{
    public function testConstructor()
    {
        $entity = new TicketSubject();

        $this->assertEquals($entity::TYPE_NEW, $entity->getType());
        $this->assertInstanceOf('DateTime', $entity->getCreated());
        $this->assertInstanceOf('DateTime', $entity->getLastEdit());

        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $entity->getTicketEntry());
        $this->assertEmpty($entity->getTicketEntry());
    }

    public function testId()
    {
        $entity = new TicketSubject();
        $id = rand(0, 99999);
        $result = $entity->setId($id);

        $this->assertEquals($entity, $result);
        $this->assertEquals($id, $result->getId());
    }

    public function testSubject()
    {
        $entity = new TicketSubject();
        $subject = 'foobar';
        $result = $entity->setSubject($subject);

        $this->assertEquals($entity, $result);
        $this->assertEquals($subject, $result->getSubject());
    }

    public function testType()
    {
        $entity = new TicketSubject();
        $type = $entity::TYPE_NEW;
        $result = $entity->setType($type);

        $this->assertEquals($entity, $result);
        $this->assertEquals($type, $result->getType());
    }

    public function testCreated()
    {
        $entity = new TicketSubject();
        $dateTime = new \DateTime();
        $result = $entity->setCreated($dateTime);

        $this->assertEquals($entity, $result);
        $this->assertEquals($dateTime, $result->getCreated());
    }

    public function testLastEdit()
    {
        $entity = new TicketSubject();
        $dateTime = new \DateTime();
        $result = $entity->setLastEdit($dateTime);

        $this->assertEquals($entity, $result);
        $this->assertEquals($dateTime, $result->getLastEdit());
    }

    public function testUser()
    {
        $entity = new TicketSubject();
        $user = new User();
        $result = $entity->setUser($user);

        $this->assertEquals($entity, $result);
        $this->assertEquals($user, $result->getUser());
    }

    public function testTicketCategory()
    {
        $entity = new TicketSubject();
        $category = new TicketCategory();
        $result = $entity->setTicketCategory($category);

        $this->assertEquals($entity, $result);
        $this->assertEquals($category, $result->getTicketCategory());
    }

    public function testTicketEntry()
    {
        $entity = new TicketSubject();
        $entry = new TicketEntry();
        $result = $entity->addTicketEntry($entry);

        $this->assertEquals($entity, $result);
        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $entity->getTicketEntry());
        $this->assertNotEmpty($entity->getTicketEntry());
        $this->assertEquals($entry, $entity->getTicketEntry()[0]);
    }
}
