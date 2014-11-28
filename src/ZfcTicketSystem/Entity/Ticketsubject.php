<?php

namespace ZfcTicketSystem\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Ticketsubject
 *
 * @ORM\Table(name="ticketSubject", indexes={@ORM\Index(name="fk_ticketSubject_users1_idx", columns={"usrId"}), @ORM\Index(name="fk_ticketSubject_ticketCategory1_idx", columns={"ticketCategory_categoryId"})})
 * @ORM\Entity(repositoryClass="ZfcTicketSystem\Entity\Repository\TicketSubject")
 */
class Ticketsubject {

	const TypeNew = 0;
	const TypeOpen = 1;
	const TypeClosed = 2;
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="ticketId", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $ticketid;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="subject", type="string", length=45, nullable=false)
	 */
	private $subject;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="type", type="string", nullable=false)
	 */
	private $type;

	/**
	 * @var UserInterface
	 *
	 * @ORM\ManyToOne(targetEntity="PServerCMS\Entity\Users")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="usrId", referencedColumnName="usrId")
	 * })
	 */
	private $user;

	/**
	 * @var Ticketcategory
	 *
	 * @ORM\ManyToOne(targetEntity="ZfcTicketSystem\Entity\Ticketcategory")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="ticketCategory_categoryId", referencedColumnName="categoryId")
	 * })
	 */
	private $ticketCategory;

	/**
	 * @var Ticketentry
	 *
	 * @ORM\OneToMany(targetEntity="ZfcTicketSystem\Entity\Ticketentry", mappedBy="subject")
	 * @ORM\OrderBy({"created" = "desc"})
	 */
	private $ticketEntry;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="last_edit", type="datetime", nullable=false)
	 */
	private $lastEdit;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created", type="datetime", nullable=false)
	 */
	private $created;

	public function __construct( ) {
		$this->type = self::TypeNew;
		$this->created = new \DateTime();
		$this->lastEdit = new \DateTime();
		$this->ticketEntry = new ArrayCollection();
	}

	/**
	 * Get ticketid
	 *
	 * @return integer
	 */
	public function getTicketid() {
		return $this->ticketid;
	}

	/**
	 * Set subject
	 *
	 * @param string $subject
	 *
	 * @return Ticketsubject
	 */
	public function setSubject( $subject ) {
		$this->subject = $subject;

		return $this;
	}

	/**
	 * Get subject
	 *
	 * @return string
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * Set type
	 *
	 * @param string $type
	 *
	 * @return Ticketsubject
	 */
	public function setType( $type ) {
		$this->type = $type;

		return $this;
	}

	/**
	 * Get type
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Set user
	 *
	 * @param UserInterface $user
	 *
	 * @return Ticketsubject
	 */
	public function setUser( UserInterface $user = null ) {
		$this->user = $user;

		return $this;
	}

	/**
	 * Get user
	 *
	 * @return UserInterface
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Set ticketCategory
	 *
	 * @param \ZfcTicketSystem\Entity\Ticketcategory $ticketCategory
	 *
	 * @return Ticketsubject
	 */
	public function setTicketCategory( \ZfcTicketSystem\Entity\Ticketcategory $ticketCategory = null ) {
		$this->ticketCategory = $ticketCategory;

		return $this;
	}

	/**
	 * Get ticketCategory
	 *
	 * @return \ZfcTicketSystem\Entity\Ticketcategory
	 */
	public function getTicketCategory() {
		return $this->ticketCategory;
	}

	/**
	 * Set ticketCategory
	 *
	 * @param Ticketentry $ticketCategory
	 *
	 * @return Ticketentry[]
	 */
	public function addTicketEntry( Ticketentry $ticketEntry = null ) {
		$this->ticketEntry[] = $ticketEntry;

		return $this;
	}

	/**
	 * Get ticketCategory
	 *
	 * @return Ticketentry[]
	 */
	public function getTicketEntry() {
		return $this->ticketEntry;
	}

	/**
	 * Set created
	 *
	 * @param \DateTime $created
	 *
	 * @return Ticketsubject
	 */
	public function setCreated( $created ) {
		$this->created = $created;

		return $this;
	}

	/**
	 * Get created
	 *
	 * @return \DateTime
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * Set latEdit
	 *
	 * @param \DateTime $lastEdit
	 *
	 * @return Ticketsubject
	 */
	public function setLastEdit( $lastEdit ) {
		$this->lastEdit = $lastEdit;

		return $this;
	}

	/**
	 * Get latEdit
	 *
	 * @return \DateTime
	 */
	public function getLastEdit() {
		return $this->lastEdit;
	}
}
