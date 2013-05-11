<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Displays entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="Beam_Plugin")
 */
class Beam_Entity_Plugin extends Zikula_EntityAccess
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
	 * The following are annotations which define the version field.
	 *
	 * @ORM\Column(type="string", length=50)
	 */
	private $version;

	/**
	 * The following are annotations which define the status field.
	 *
	 * @ORM\Column(type="boolean")
	 */
	private $active;

	/**
	 * The following are annotations which define the started field.
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $installhints;


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

	public function getVersion()
	{
		return $this->version;
	}

	public function getActive()
	{
		return $this->active;
	}

	public function getInstallhints()
	{
		return $this->installhints;
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

	public function setVersion($v)
	{
		$this->version = $v;
	}

	public function setActive($v)
	{
		$this->active = $v;
	}

	public function setInstallhints($v)
	{
		$this->installhints = $v;
	}

}
