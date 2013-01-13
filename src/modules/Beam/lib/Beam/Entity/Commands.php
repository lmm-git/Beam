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
	private $code;

	/**
	 * The following are annotations which define the type field.
	 *
	 * @ORM\Column(type="integer")
	 */
	private $type;

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

	public function getCode()
	{
		return $this->code;
	}

	public function getType()
	{
		return $this->type;
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

	public function setCode($v)
	{
		$this->code = $v;
	}

	public function setType($v)
	{
		$this->type = $v;
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
