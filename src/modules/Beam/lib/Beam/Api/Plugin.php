<?php
/**
 * Beam Plugin bus
 *
 * @license    GPLv3
 * @package    Beam/Plugin
 */
class Beam_Api_Plugin extends Zikula_AbstractApi
{
	/**
	 * Refresh Beam plugin
	 *
	 *
	 * @author Leonard Marschke
	 * @return true/false
	 */
	public function refreshPlugins()
	{
		//get all files
		$handle = opendir(__DIR__ . '/../Plugins');
		while($file = readdir($handle)) {
			if($file != str_replace('.php', '', $file)) {
				$plugins[] = $file;
				require_once(__DIR__ . '/../Plugins/' . $file);
				$name = str_replace('.php', '', $file);
				$class = "Beam_Plugins_" . $name;
				//check if plugin is already registered
				$check = $this->entityManager->getRepository('Beam_Entity_Plugin')->findOneBy(array('name' => $name));
				if($check['name'] == $name) {
					$update = $check;
				} else {
					$update = new Beam_Entity_Plugin();
					$update->setActive(true);
				}
				$update->merge($class::version());
				$this->entityManager->persist($update);
			}
		}
		$this->entityManager->flush();
		return true;
	}
	
	
}

