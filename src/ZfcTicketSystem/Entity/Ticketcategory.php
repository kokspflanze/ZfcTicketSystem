<?php

namespace ZfcTicketSystem\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticketcategory
 *
 * @ORM\Table(name="ticketCategory")
 * @ORM\Entity(repositoryClass="ZfcTicketSystem\Entity\Repository\TicketCategory")
 */
class Ticketcategory {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="categoryId", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $categoryid;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="subject", type="string", length=45, nullable=false)
	 */
	private $subject;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="sortkey", type="smallint", nullable=false)
	 */
	private $sortkey;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="active", type="string", nullable=false)
	 */
	private $active;


	/**
	 * Get categoryid
	 *
	 * @return integer
	 */
	public function getCategoryid() {
		return $this->categoryid;
	}

	/**
	 * Set subject
	 *
	 * @param string $subject
	 *
	 * @return Ticketcategory
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
	 * Set sortkey
	 *
	 * @param integer $sortkey
	 *
	 * @return Ticketcategory
	 */
	public function setSortkey( $sortkey ) {
		$this->sortkey = $sortkey;

		return $this;
	}

	/**
	 * Get sortkey
	 *
	 * @return integer
	 */
	public function getSortkey() {
		return $this->sortkey;
	}

	/**
	 * Set active
	 *
	 * @param string $active
	 *
	 * @return Ticketcategory
	 */
	public function setActive( $active ) {
		$this->active = $active;

		return $this;
	}

	/**
	 * Get active
	 *
	 * @return string
	 */
	public function getActive() {
		return $this->active;
	}
}
