<?php
/**
 * Beam
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
		$cat = CategoryUtil::getCategoryByPath('/__SYSTEM__/Modules/Beam');
		return array('GroundCatID' => $cat['id']);
	}

	/**
	 * Initialise the Locator module.
	 *
	 * @author Leonard Marschke
	 * @return boolean: true on success / false on failure.
	 */
	public function install()
	{
		Loader::loadClass('CategoryUtil');
		Loader::loadClassFromModule('Categories', 'Category');
		Loader::loadClassFromModule('Categories', 'CategoryRegistry');

		try {
			DoctrineHelper::createSchema($this->entityManager, array(
				'Beam_Entity_Displays'
			));
		} catch (Exception $e) {
			echo $e;
			return false;
		}
		
		try {
			DoctrineHelper::createSchema($this->entityManager, array(
				'Beam_Entity_Commands'
			));
		} catch (Exception $e) {
			echo $e;
			return false;
		}
		
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
		//Remove all databases
		DoctrineHelper::dropSchema($this->entityManager, array(
			'Beam_Entity_Displays'
		));
		DoctrineHelper::dropSchema($this->entityManager, array(
			'Beam_Entity_Commands'
		));
		
		//Remove all ModVars
		$this->delVars();
		return true;
	}
	
	
	
	private function createCategoryTree()
	{

		// Create the global Category Registry
		$c = CategoryUtil::getCategoryByPath('/__SYSTEM__/Modules/Beam');
		if($c)
			return true;

		$args = array(
				'prop' => 'Beam',
				'cid'  => $c['id']
		);
		$this->createCategoryRegistry($args);
		
		$c = CategoryUtil::getCategoryByPath('/__SYSTEM__/Modules');

		$args = array(
				'cid'   => $c['id'],
				'name'  => 'Beam',
				'dname' => array($lang => $this->__('Beam')),
				'ddesc' => array($lang => $this->__('Beam commands category'))
		);
		$this->createCategory($args);
	}
	
	private function createCategoryRegistry($args)
	{
		$registry = new Categories_DBObject_Registry();
		$registry->setDataField('modname',     'Beam');
		$registry->setDataField('property',    $args['prop']);
		$registry->setDataField('category_id', $args['cid']);
		if ($registry->validatePostProcess()) {
			$registry->insert();
		}
		FormUtil::clearValidationErrors();
	}
}
