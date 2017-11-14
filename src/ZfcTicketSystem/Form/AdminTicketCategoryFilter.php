<?php


namespace ZfcTicketSystem\Form;

use Zend\Filter;
use Zend\I18n\Validator\IsInt;
use Zend\InputFilter\InputFilter;
use Zend\Validator;

class AdminTicketCategoryFilter extends InputFilter
{
    public function __construct()
    {
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
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'sort_key',
            'required' => false,
            'validators' => [
                [
                    'name' => IsInt::class,
                ],
            ],
        ]);

        $this->add([
            'name' => 'active',
            'required' => true,
            'validators' => [
                [
                    'name' => Validator\InArray::class,
                    'options' => [
                        'haystack' => [0, 1],
                    ],
                ],
            ],
        ]);
    }
}