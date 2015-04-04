<?php

namespace ZfcTicketSystem\Entity;

use SmallUser\Entity\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TicketSubject
 * @ORM\Table(name="ticket_subject", indexes={@ORM\Index(name="fk_ticketSubject_users1_idx", columns={"usrId"}), @ORM\Index(name="fk_ticketSubject_ticketCategory1_idx", columns={"ticket_category"})})
 * @ORM\Entity(repositoryClass="ZfcTicketSystem\Entity\Repository\TicketSubject")
 */
class TicketSubject
{
    const TYPE_NEW = 0;
    const TYPE_OPEN = 1;
    const TYPE_CLOSED = 2;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="subject", type="string", length=45, nullable=false)
     */
    private $subject;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    private $type;

    /**
     * @var UserInterface
     * @ORM\ManyToOne(targetEntity="SmallUser\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usrId", referencedColumnName="usrId")
     * })
     */
    private $user;

    /**
     * @var TicketCategory
     * @ORM\ManyToOne(targetEntity="TicketCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ticket_category", referencedColumnName="id")
     * })
     */
    private $ticketCategory;

    /**
     * @var TicketEntry
     * @ORM\OneToMany(targetEntity="TicketEntry", mappedBy="subject")
     * @ORM\OrderBy({"created" = "desc"})
     */
    private $ticketEntry;

    /**
     * @var \DateTime
     * @ORM\Column(name="last_edit", type="datetime", nullable=false)
     */
    private $lastEdit;

    /**
     * @var \DateTime
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    public function __construct()
    {
        $this->type        = self::TYPE_NEW;
        $this->created     = new \DateTime();
        $this->lastEdit    = new \DateTime();
        $this->ticketEntry = new ArrayCollection();
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId( $id )
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set subject
     * @param string $subject
     * @return TicketSubject
     */
    public function setSubject( $subject )
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set type
     * @param string $type
     * @return TicketSubject
     */
    public function setType( $type )
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user
     * @param UserInterface $user
     * @return TicketSubject
     */
    public function setUser( UserInterface $user = null )
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ticketCategory
     * @param TicketCategory $ticketCategory
     * @return TicketSubject
     */
    public function setTicketCategory( TicketCategory $ticketCategory = null )
    {
        $this->ticketCategory = $ticketCategory;

        return $this;
    }

    /**
     * Get ticketCategory
     * @return TicketCategory
     */
    public function getTicketCategory()
    {
        return $this->ticketCategory;
    }

    /**
     * Set created
     * @param \DateTime $created
     * @return TicketSubject
     */
    public function setCreated( $created )
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set latEdit
     * @param \DateTime $lastEdit
     * @return $this
     */
    public function setLastEdit( $lastEdit )
    {
        $this->lastEdit = $lastEdit;

        return $this;
    }

    /**
     * Get latEdit
     * @return \DateTime
     */
    public function getLastEdit()
    {
        return $this->lastEdit;
    }

    /**
     * Set ticketCategory
     * @param TicketEntry $ticketCategory
     * @return $this
     */
    public function addTicketEntry( TicketEntry $ticketEntry = null )
    {
        $this->ticketEntry[] = $ticketEntry;

        return $this;
    }

    /**
     * Get ticketCategory
     * @return ArrayCollection|TicketEntry[]
     */
    public function getTicketEntry()
    {
        return $this->ticketEntry;
    }
}
