<?php

namespace ZfcTicketSystem\Mapper;

use Zend\Hydrator\ClassMethods;
use ZfcTicketSystem\Entity\TicketEntry;

class HydratorTicketEntry extends ClassMethods
{

    /**
     * Extract values from an object
     * @param  object $object
     * @return array
     * @throws \InvalidArgumentException
     */
    public function extract($object)
    {
        if (!$object instanceof TicketEntry) {
            throw new \InvalidArgumentException('$object must be an instance of TicketEntry');
        }
        /* @var $object TicketEntry */
        $data = parent::extract($object);

        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     * @param  array $data
     * @param  object $object
     * @return TicketEntry
     * @throws \InvalidArgumentException
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof TicketEntry) {
            throw new \InvalidArgumentException('$object must be an instance of TicketEntry');
        }

        return parent::hydrate($data, $object);
    }
} 