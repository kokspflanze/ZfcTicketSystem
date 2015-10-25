<?php

namespace ZfcTicketSystem\Entity;

use SmallUser\Entity\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * TicketEntry
 * @ORM\Table(name="ticket_entry", indexes={@ORM\Index(name="fk_ticketEntry_ticketSubject1_idx", columns={"ticket_subject"}),@ORM\Index(name="fk_ticketEntry_users1_idx", columns={"usrId"})})
 * @ORM\Entity(repositoryClass="ZfcTicketSystem\Entity\Repository\TicketEntry")
 */
class TicketEntry
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="memo", type="text", nullable=false)
     */
    private $memo;

    /**
     * @var UserInterface
     * @ORM\ManyToOne(targetEntity="SmallUser\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usrId", referencedColumnName="usrId")
     * })
     */
    private $user;

    /**
     * @var TicketSubject
     * @ORM\ManyToOne(targetEntity="TicketSubject", inversedBy="ticketEntry")
     * @ORM\JoinColumn(name="ticket_subject", referencedColumnName="id")
     */
    private $subject;

    /**
     * @var \DateTime
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
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
     * Set memo
     * @param string $memo
     * @return TicketEntry
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;

        return $this;
    }

    /**
     * Get memo
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Set user
     * @param UserInterface $user
     * @return TicketEntry
     */
    public function setUser(UserInterface $user = null)
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
     * @return TicketSubject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param TicketSubject $subject
     * @return TicketEntry
     */
    public function setSubject(TicketSubject $subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Set created
     * @param \DateTime $created
     * @return TicketEntry
     */
    public function setCreated($created)
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
}
