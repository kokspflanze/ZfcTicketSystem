<?php

namespace ZfcTicketSystem\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticketentry
 *
 * @ORM\Table(name="ticketEntry", indexes={@ORM\Index(name="fk_ticketEntry_ticketSubject1_idx", columns={"ticketSubject_ticketId"}), @ORM\Index(name="fk_ticketEntry_users1_idx", columns={"users_usrId"})})
 * @ORM\Entity
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
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created", type="datetime", nullable=false)
	 */
	private $created;

	/**
	 * @var \PServerCMS\Entity\Ticketsubject
	 *
	 * @ORM\ManyToOne(targetEntity="PServerCMS\Entity\Ticketsubject")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="ticketSubject_ticketId", referencedColumnName="ticketId")
	 * })
	 */
	private $ticketsubjectTicketid;

	/**
	 * @var \PServerCMS\Entity\Users
	 *
	 * @ORM\ManyToOne(targetEntity="PServerCMS\Entity\Users")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="users_usrId", referencedColumnName="usrId")
	 * })
	 */
	private $usersUsrid;

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

	/**
	 * Set ticketsubjectTicketid
	 *
	 * @param \PServerCMS\Entity\Ticketsubject $ticketsubjectTicketid
	 *
	 * @return Ticketentry
	 */
	public function setTicketsubjectTicketid( \PServerCMS\Entity\Ticketsubject $ticketsubjectTicketid = null ) {
		$this->ticketsubjectTicketid = $ticketsubjectTicketid;

		return $this;
	}

	/**
	 * Get ticketsubjectTicketid
	 *
	 * @return \PServerCMS\Entity\Ticketsubject
	 */
	public function getTicketsubjectTicketid() {
		return $this->ticketsubjectTicketid;
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
}
