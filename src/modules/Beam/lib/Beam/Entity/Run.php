<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Displays entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="Beam_Run")
 */
class Beam_Entity_Run extends Zikula_EntityAccess
{

	/**
	 * The following are annotations which define the id field.
	 *
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;


	/**
	 * The following are annotations which define the display-id field.
	 *
	 * @ORM\Column(type="integer")
	 */
	private $did;

	/**
	 * The following are annotations which define the command-id field.
	 *
	 * @ORM\Column(type="integer")
	 */
	private $cid;

	/**
	 * The following are annotations which define the windowid field.
	 *
	 * @ORM\Column(type="integer", nullable=true)
	 */
	private $windowid;

	/**
	 * The following are annotations which define the status field.
	 *
	 * @ORM\Column(type="integer")
	 */
	private $status;

	/**
	 * The following are annotations which define the started field.
	 *
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	private $start;


	//getting section

	public function getId()
	{
		return $this->id;
	}

	public function getDid()
	{
		return $this->did;
	}

	public function getCid()
	{
		return $this->cid;
	}

	public function getWindowid()
	{
		return $this->windowid;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getStart()
	{
		return $this->start;
	}

	//setting section

	public function setDid($v)
	{
		$this->did = $v;
	}

	public function setCid($v)
	{
		$this->cid = $v;
	}

	public function setWindowid($v)
	{
		$this->windowid = $v;
	}

	public function setStatus($v)
	{
		$this->status = $v;
	}

	public function setStart($v)
	{
		$this->start = new DateTime($v);
	}

}
