<?php

namespace ZfcTicketSystem\Form;

use Doctrine\ORM\EntityManager;
use Zend\Filter;
use Zend\InputFilter\InputFilter;
use Zend\Validator;
use ZfcTicketSystem\Options\EntityOptions;

class TicketSystemFilter extends InputFilter
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
            'filters' => [
                ['name' => Filter\StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => Validator\StringLength::class,
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
                    'name' => Validator\InArray::class,
                    'options' => [
                        'haystack' => $this->getTicketCategory(),
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'memo',
            'required' => true,
            'filters' => [
                ['name' => Filter\StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => Validator\StringLength::class,
                    'options' => [
                        'min' => 3,
                        'max' => 65535,
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