<?php


namespace ZfcTicketSystem\Mapper;

use ZfcUser\Mapper\Exception;
use Zend\Stdlib\Hydrator\ClassMethods;
use ZfcTicketSystem\Entity\TicketCategory;

class HydratorTicketCategory extends ClassMethods
{

    /**
     * Extract values from an object
     * @param  object $object
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    public function extract( $object )
    {
        if (!$object instanceof TicketCategory) {
            throw new Exception\InvalidArgumentException( '$object must be an instance of TicketCategory' );
        }
        /* @var $object TicketCategory */
        $data = parent::extract( $object );

        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     * @param  array  $data
     * @param  object $object
     * @return TicketCategory
     * @throws Exception\InvalidArgumentException
     */
    public function hydrate( array $data, $object )
    {
        if (!$object instanceof TicketCategory) {
            throw new Exception\InvalidArgumentException( '$object must be an instance of TicketCategory' );
        }

        return parent::hydrate( $data, $object );
    }
}