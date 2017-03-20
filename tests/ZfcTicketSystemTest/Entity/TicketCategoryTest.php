<?php


namespace ZfcTicketSystemTest\Entity;


use PHPUnit\Framework\TestCase;
use ZfcTicketSystem\Entity\TicketCategory;

class TicketCategoryTest extends TestCase
{
    public function testId()
    {
        $entity = new TicketCategory();
        $id = rand(0, 99999);
        $result = $entity->setId($id);

        $this->assertEquals($entity, $result);
        $this->assertEquals($id, $result->getId());
    }

    public function testSubject()
    {
        $entity = new TicketCategory();
        $subject = 'foobar';
        $result = $entity->setSubject($subject);

        $this->assertEquals($entity, $result);
        $this->assertEquals($subject, $result->getSubject());
    }

    public function testSortKey()
    {
        $entity = new TicketCategory();
        $sortKey = rand(0, 99999);
        $result = $entity->setSortKey($sortKey);

        $this->assertEquals($entity, $result);
        $this->assertEquals($sortKey, $result->getSortKey());
    }

    public function testActive()
    {
        $entity = new TicketCategory();
        $sortKey = '1';
        $result = $entity->setActive($sortKey);

        $this->assertEquals($entity, $result);
        $this->assertEquals($sortKey, $result->getActive());
    }
}
