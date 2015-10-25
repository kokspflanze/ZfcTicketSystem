<?php

namespace ZfcTicketSystem\Form;

use ZfcBase\InputFilter\ProvidesEventsInputFilter;
use Zend\ServiceManager\ServiceLocatorInterface;

class TicketSystemFilter extends ProvidesEventsInputFilter
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceManager;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function __construct(ServiceLocatorInterface $serviceManager)
    {
        $this->setServiceManager($serviceManager);

        $this->add(array(
            'name' => 'subject',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 3,
                        'max' => 255,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'categoryId',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'InArray',
                    'options' => array(
                        'haystack' => $this->getTicketCategory(),
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'memo',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 3,
                    ),
                ),
            ),
        ));
    }

    /**
     * @param ServiceLocatorInterface $serviceManager
     * @return $this
     */
    public function setServiceManager(ServiceLocatorInterface $serviceManager)
    {
        $this->serviceManager = $serviceManager;

        return $this;
    }

    /**
     * @return array
     */
    protected function getTicketCategory()
    {
        /** @var \ZfcTicketSystem\Entity\Repository\TicketCategory $ticketCategory */
        $ticketCategory = $this->getEntityManager()->getRepository(
            $this->getServiceManager()->get('zfcticketsystem_entry_options')->getTicketCategory()
        );

        $category = $ticketCategory->getActiveCategory();

        $result = array();
        foreach ($category as $entry) {
            $result[] = $entry->getId();
        }

        return $result;
    }

    /**
     * @return ServiceLocatorInterface
     */
    protected function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        if (!$this->entityManager) {
            $this->entityManager = $this->getServiceManager()->get('Doctrine\ORM\EntityManager');
        }

        return $this->entityManager;
    }
} 