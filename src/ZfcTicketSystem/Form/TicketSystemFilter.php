<?php

namespace ZfcTicketSystem\Form;

use Doctrine\ORM\EntityManager;
use ZfcBase\InputFilter\ProvidesEventsInputFilter;
use ZfcTicketSystem\Options\EntityOptions;

class TicketSystemFilter extends ProvidesEventsInputFilter
{
    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var EntityOptions
     */
    protected $entityOptions;

    public function __construct(EntityManager $entityManager, EntityOptions $entityOptions)
    {
        $this->entityManager = $entityManager;
        $this->entityOptions = $entityOptions;

        $this->add([
            'name' => 'subject',
            'required' => true,
            'filters' => [['name' => 'StringTrim']],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 3,
                        'max' => 255,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'categoryId',
            'required' => true,
            'validators' => [
                [
                    'name' => 'InArray',
                    'options' => [
                        'haystack' => $this->getTicketCategory(),
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'memo',
            'required' => true,
            'filters' => [['name' => 'StringTrim']],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 3,
                    ],
                ],
            ],
        ]);
    }

    /**
     * @return array
     */
    protected function getTicketCategory()
    {
        /** @var \ZfcTicketSystem\Entity\Repository\TicketCategory $ticketCategory */
        $ticketCategory = $this->entityManager->getRepository(
            $this->entityOptions->getTicketCategory()
        );

        $category = $ticketCategory->getActiveCategory();

        $result = [];
        foreach ($category as $entry) {
            $result[] = $entry->getId();
        }

        return $result;
    }


} 