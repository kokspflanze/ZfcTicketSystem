<?php

namespace ZfcTicketSystem\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticketentry
 *
 * @ORM\Table(name="ticketEntry", indexes={@ORM\Index(name="fk_ticketEntry_ticketSubject1_idx", columns={"ticketSubject_ticketId"}), @ORM\Index(name="fk_ticketEntry_users1_idx", columns={"users_usrId"})})
 * @ORM\Entity(repositoryClass="ZfcTicketSystem\Entity\Repository\TicketEntry")
 */
class Ticketentry {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="ticketEntryId", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $ticketentryid;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="memo", type="text", nullable=false)
	 */
	private $memo;

	/**
	 * @var \PServerCMS\Entity\Users
	 *
	 * @ORM\ManyToOne(targetEntity="PServerCMS\Entity\Users")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="users_usrId", referencedColumnName="usrId")
	 * })
	 */
	private $usersUsrid;

	/**
	 * @var integer
	 *
	 * @ORM\ManyToOne(targetEntity="Ticketsubject", inversedBy="ticketEntry")
	 * @ORM\JoinColumn(name="ticketSubject_ticketId", referencedColumnName="ticketId")
	 */
	private $subject;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created", type="datetime", nullable=false)
	 */
	private $created;

	public function __construct( ) {
		$this->created = new \DateTime();
	}

	/**
	 * Get ticketentryid
	 *
	 * @return integer
	 */
	public function getTicketentryid() {
		return $this->ticketentryid;
	}

	/**
	 * Set memo
	 *
	 * @param string $memo
	 *
	 * @return Ticketentry
	 */
	public function setMemo( $memo ) {
		$this->memo = $memo;

		return $this;
	}

	/**
	 * Get memo
	 *
	 * @return string
	 */
	public function getMemo() {
		return $this->memo;
	}

	/**
	 * Set usersUsrid
	 *
	 * @param \PServerCMS\Entity\Users $usersUsrid
	 *
	 * @return Ticketentry
	 */
	public function setUsersUsrid( \PServerCMS\Entity\Users $usersUsrid = null ) {
		$this->usersUsrid = $usersUsrid;

		return $this;
	}

	/**
	 * Get usersUsrid
	 *
	 * @return \PServerCMS\Entity\Users
	 */
	public function getUsersUsrid() {
		return $this->usersUsrid;
	}

	/**
	 * @param Ticketsubject $subject
	 *
	 * @return Ticketentry
	 */
	public function setSubject( Ticketsubject $subject){
		$this->subject = $subject;

		return $this;
	}

	/**
	 * Set created
	 *
	 * @param \DateTime $created
	 *
	 * @return Ticketentry
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
}
