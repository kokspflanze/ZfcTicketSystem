<?php


namespace ZfcTicketSystem\Service;

use Doctrine\ORM\EntityManager;
use ZfcTicketSystem\Form\AdminTicketCategory;
use ZfcTicketSystem\Mapper\HydratorTicketCategory;
use ZfcTicketSystem\Options\EntityOptions;

class Category
{
    /** @var  AdminTicketCategory */
    protected $adminForm;
    /** @var  EntityManager */
    protected $entityManager;
    /** @var  EntityOptions */
    protected $entityOptions;

    /**
     * Category constructor.
     * @param AdminTicketCategory $adminForm
     * @param EntityManager $entityManager
     * @param EntityOptions $entityOptions
     */
    public function __construct(
        AdminTicketCategory $adminForm,
        EntityManager $entityManager,
        EntityOptions $entityOptions
    ) {
        $this->adminForm = $adminForm;
        $this->entityManager = $entityManager;
        $this->entityOptions = $entityOptions;
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
     * @param $categoryId
     *
     * @return null|\ZfcTicketSystem\Entity\TicketCategory
     */
    public function getCategory4Id($categoryId)
    {
        /** @var \ZfcTicketSystem\Entity\Repository\TicketCategory $repository */
        $repository = $this->getEntityManager()->getRepository($this->getEntityOptions()->getTicketCategory());
        return $repository->getCategory4Id($categoryId);
    }

    /**
     * @return AdminTicketCategory
     */
    public function getForm()
    {
        return $this->adminForm;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @return EntityOptions
     */
    public function getEntityOptions()
    {
        return $this->entityOptions;
    }

}