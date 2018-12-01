<?php

namespace ZfcTicketSystem\Mapper;

use Zend\Hydrator\ClassMethods;
use ZfcTicketSystem\Entity\TicketCategory;

class HydratorTicketCategory extends ClassMethods
{

    /**
     * Extract values from an object
     * @param  object $object
     * @return array
     * @throws \InvalidArgumentException
     */
    public function extract($object)
    {
        if (!$object instanceof TicketCategory) {
            throw new \InvalidArgumentException('$object must be an instance of TicketCategory');
        }
        /* @var $object TicketCategory */
        $data = parent::extract($object);

        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     * @param  array $data
     * @param  object $object
     * @return TicketCategory
     * @throws \InvalidArgumentException
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof TicketCategory) {
            throw new \InvalidArgumentException('$object must be an instance of TicketCategory');
        }

        return parent::hydrate($data, $object);
    }
}