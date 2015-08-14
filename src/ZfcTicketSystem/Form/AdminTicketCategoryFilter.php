<?php


namespace ZfcTicketSystem\Form;

use ZfcBase\InputFilter\ProvidesEventsInputFilter;

class AdminTicketCategoryFilter extends ProvidesEventsInputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'subject',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 1,
                        'max' => 200,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'sort_key',
            'required' => false,
            'validators' => array(
                array(
                    'name' => 'IsInt',
                ),
            ),
        ));

        $this->add(array(
            'name' => 'active',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'InArray',
                    'options' => array(
                        'haystack' => array(0, 1),
                    ),
                ),
            ),
        ));
    }
}