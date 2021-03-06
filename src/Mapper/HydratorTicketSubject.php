<?php

namespace ZfcTicketSystem\Mapper;

use Laminas\Hydrator\ClassMethodsHydrator;
use ZfcTicketSystem\Entity\TicketSubject;

class HydratorTicketSubject extends ClassMethodsHydrator
{

    /**
     * Extract values from an object
     * @param  object $object
     * @return array
     * @throws \InvalidArgumentException
     */
    public function extract($object): array
    {
        if (!$object instanceof TicketSubject) {
            throw new \InvalidArgumentException('$object must be an instance of TicketSubject');
        }
        /* @var $object TicketSubject */
        $data = parent::extract($object);

        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     * @param  array $data
     * @param  object $object
     * @return TicketSubject
     * @throws \InvalidArgumentException
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof TicketSubject) {
            throw new \InvalidArgumentException('$object must be an instance of TicketSubject');
        }

        return parent::hydrate($data, $object);
    }
} 