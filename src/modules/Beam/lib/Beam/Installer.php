<?php
/**
 * Locator
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    Beam/Installer
 */
class Beam_Installer extends Zikula_AbstractInstaller
{

	/**
	 * Provides an array containing default values for module variables (settings).
	 *
	 * @author Leonard Marschke
	 * @return array An array indexed by variable name containing the default values for those variables.
	 */
	protected function getDefaultModVars()
	{
		return array();
	}

	/**
	 * Initialise the Locator module.
	 *
	 * @author Leonard Marschke
	 * @return boolean: true on success / false on failure.
	 */
	public function install()
	{
		$this->setVars($this->getDefaultModVars());
		// Initialisation successful
		return true;
	}


	/**
	 * Upgrading the module
	 *
	 * @author Leonard Marschke
	 * @return boolean: true on success / false on error
	 * @param $oldversion
	 */
	public function upgrade($oldversion)
	{
		return true;
	}

	/**
	 * Uninstall the module
	 *
	 * @author Leonard Marschke
	 * @return boolean: true on success / false on error
	 */
	public function uninstall()
	{
		//Remove all ModVars
		$this->delVars();
		return true;
	}
}
