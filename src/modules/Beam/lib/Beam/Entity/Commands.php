<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Persons entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="Beam_Commands")
 */
class Beam_Entity_Commands extends Zikula_EntityAccess
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
	 * The following are annotations which define the code field.
	 *
	 * @ORM\Column(type="text")
	 */
	private $codeStart;

	/**
	 * The following are annotations which define the code field.
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $codeStop;

	/**
	 * The following are annotations which define the code field.
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $codePauseStart;

	/**
	 * The following are annotations which define the code field.
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $codePauseStop;

	/**
	 * The following are annotations which define the type field.
	 *
	 * @ORM\Column(type="integer")
	 */
	private $jType;

	/**
	 * The following are annotations which define the category field.
	 *
	 * @ORM\Column(type="integer")
	 */
	private $category;

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

	public function getCodeStart()
	{
		return $this->codeStart;
	}

	public function getCodeStop()
	{
		return $this->codeStop;
	}

	public function getCodePauseStart()
	{
		return $this->codePauseStart;
	}

	public function getCodePauseStop()
	{
		return $this->codePauseStop;
	}

	public function getJType()
	{
		return $this->jType;
	}

	public function getCategory()
	{
		return $this->category;
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

	public function setCodeStart($v)
	{
		$this->codeStart = $v;
	}

	public function setCodeStop($v)
	{
		$this->codeStop = $v;
	}

	public function setCodePauseStart($v)
	{
		$this->codePauseStart = $v;
	}

	public function setCodePauseStop($v)
	{
		$this->codePauseStop = $v;
	}

	public function setJType($v)
	{
		$this->jType = $v;
	}

	public function setCategory($v)
	{
		$this->category = $v;
	}

	public function setActive($v)
	{
		$this->active = $v;
	}

}
