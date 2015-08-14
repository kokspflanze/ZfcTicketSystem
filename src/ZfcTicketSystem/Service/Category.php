<?php


namespace ZfcTicketSystem\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use ZfcTicketSystem\Mapper\HydratorTicketCategory;

class Category implements ServiceManagerAwareInterface
{
    /** @var ServiceManager */
    protected $serviceManager;
    /** @var \Doctrine\ORM\EntityManager */
    protected $entityManager;
    /** @var  \ZfcTicketSystem\Options\EntityOptions */
    protected $entityOptions;

    /**
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @param array $data
     * @param \ZfcTicketSystem\Entity\TicketCategory|null $currentCategory
     * @return bool|\ZfcTicketSystem\Entity\TicketCategory
     */
    public function setCategory(array $data, $currentCategory = null)
    {
        if (!$currentCategory) {
            $class = $this->getEntityOptions()->getTicketCategory();
            $currentCategory = new $class();
        }

        $form = $this->getForm();
        $form->setHydrator(new HydratorTicketCategory());
        $form->bind($currentCategory);
        $form->setData($data);

        if (!$form->isValid()) {
            return false;
        }

        /** @var \ZfcTicketSystem\Entity\TicketCategory $ticketCategory */
        $ticketCategory = $form->getData();

        $entity = $this->getEntityManager();
        $entity->persist($ticketCategory);
        $entity->flush();

        return $ticketCategory;
    }

    /**
     * @param ServiceManager $serviceManager
     * @return $this
     */
    public function setServiceManager( ServiceManager $serviceManager )
    {
        $this->serviceManager = $serviceManager;

        return $this;
    }

    /**
     * @param $categoryId
     *
     * @return null|\ZfcTicketSystem\Entity\TicketCategory
     */
    public function getCategory4Id( $categoryId )
    {
        /** @var \ZfcTicketSystem\Entity\Repository\TicketCategory $repository */
        $repository = $this->getEntityManager()->getRepository($this->getEntityOptions()->getTicketCategory());
        return $repository->getCategory4Id($categoryId);
    }

    /**
     * @return \ZfcTicketSystem\Form\AdminTicketCategory
     */
    public function getForm()
    {
        return $this->getServiceManager()->get('zfcticketsystem_admin_category_form');
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (!$this->entityManager) {
            $this->entityManager = $this->getServiceManager()->get( 'Doctrine\ORM\EntityManager' );
        }

        return $this->entityManager;
    }

    /**
     * @return \ZfcTicketSystem\Options\EntityOptions
     */
    public function getEntityOptions()
    {
        if (!$this->entityOptions) {
            $this->entityOptions = $this->getServiceManager()->get( 'zfcticketsystem_entry_options' );
        }

        return $this->entityOptions;
    }

}