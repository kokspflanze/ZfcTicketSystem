<?php


namespace ZfcTicketSystem\Form;

use Zend\InputFilter\InputFilter;

class AdminTicketCategoryFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'subject',
            'required' => true,
            'filters' => [['name' => 'StringTrim']],
            'validators' => [
                [
                    'name' => 'StringLength',
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
                    'name' => 'IsInt',
                ],
            ],
        ]);

        $this->add([
            'name' => 'active',
            'required' => true,
            'validators' => [
                [
                    'name' => 'InArray',
                    'options' => [
                        'haystack' => [0, 1],
                    ],
                ],
            ],
        ]);
    }
}