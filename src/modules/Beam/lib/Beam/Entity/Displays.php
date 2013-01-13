<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Displays entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="Beam_Displays")
 */
class Beam_Entity_Displays extends Zikula_EntityAccess
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
	 * The following are annotations which define the name field.
	 *
	 * @ORM\Column(type="string")
	 */
	private $name;

	/**
	 * The following are annotations which define the description field.
	 *
	 * @ORM\Column(type="text")
	 */
	private $description;

	/**
	 * The following are annotations which define the place field.
	 *
	 * @ORM\Column(type="string")
	 */
	private $place;

	/**
	 * The following are annotations which define the ipDisplay field.
	 *
	 * @ORM\Column(type="string")
	 */
	private $ipDisplay;

	/**
	 * The following are annotations which define the ipController field.
	 *
	 * @ORM\Column(type="string")
	 */
	private $ipController;

	/**
	 * The following are annotations which define the active field.
	 *
	 * @ORM\Column(type="boolean")
	 */
	private $active;


	//getting section

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getPlace()
	{
		return $this->place;
	}

	public function getIpDisplay()
	{
		return $this->ipDisplay;
	}

	public function getIpController()
	{
		return $this->ipController;
	}

	public function getActive()
	{
		return $this->active;
	}

	//setting section

	public function setName($v)
	{
		$this->name = $v;
	}

	public function setDescription($v)
	{
		$this->description = $v;
	}

	public function setPlace($v)
	{
		$this->place = $v;
	}

	public function setIpDisplay($v)
	{
		$this->ipDisplay = $v;
	}

	public function setIpController($v)
	{
		$this->ipController = $v;
	}

	public function setActive($v)
	{
		$this->active = $v;
	}
}