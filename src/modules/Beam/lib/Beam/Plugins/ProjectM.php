<?php
/**
 * Beam projectM plugin
 *
 * @license    GPLv3
 * @package    Beam/Plugins/projectM
 */
class Beam_Plugins_ProjectM 
{
	public function version() {
		return array(
			'version' => '0.1',
			'name' => $this->__('ProjectM'),
			'description' => $this->__('Plugin to control the ProjectM audio visualisation'),
			'installhints' => $this->__('To use this plugin please read the docs!')
		);
	}
}
