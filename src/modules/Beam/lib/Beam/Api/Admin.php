<?php
/**
 * Beam Adminapi bus
 *
 * @license    GPLv3
 * @package    Beam/Adminapi
 */
class Beam_Api_Admin extends Zikula_AbstractApi
{
	/**
	 * Get admin panel links.
	 *
	 *
	 * @author Leonard Marschke
	 * @return array Array of admin links.
	 */
	public function getlinks()
	{
		$links = array ();

		if(SecurityUtil::checkPermission('Beam::', '::', ACCESS_ADMIN))
			$links[] = array (
				'url'  => ModUtil::url('Beam', 'admin', 'dashboard'),
				'text' => $this->__('Dashboard'),
				'class'=> 'z-icon-es-home'
			);

		if(SecurityUtil::checkPermission('Beam::', 'Displays::', ACCESS_ADMIN))
			$links[] = array (
				'url'  => ModUtil::url('Beam', 'admin', 'viewDisplays'),
				'text' => $this->__('View displays'),
				'class'=> 'z-icon-es-view'
			);

		if(SecurityUtil::checkPermission('Beam::', 'Displays::', ACCESS_ADMIN))
			$links[] = array (
				'url'  => ModUtil::url('Beam', 'admin', 'configureDisplay'),
				'text' => $this->__('Add display'),
				'class'=> 'z-icon-es-new'
			);

		if(SecurityUtil::checkPermission('Beam::', 'Jobs::', ACCESS_ADMIN))
			$links[] = array (
				'url'  => ModUtil::url('Beam', 'admin', 'viewJobs'),
				'text' => $this->__('View jobs'),
				'class'=> 'z-icon-es-view'
			);

		if(SecurityUtil::checkPermission('Beam::', 'Jobs::', ACCESS_ADMIN))
			$links[] = array (
				'url'  => ModUtil::url('Beam', 'admin', 'configureJob'),
				'text' => $this->__('Add job'),
				'class'=> 'z-icon-es-new'
			);

		return $links;
	}
	
	/**
	 * Get extra code row
	 *
	 *
	 * @author Leonard Marschke
	 * @return string html string
	 */
	public function getExtraCodeRow($args)
	{
		$render = Zikula_View::getInstance();
		$render->assign('no', $args['no']);
		$render->assign('code', $args['code']);
		$render->assign('title', $args['title']);
		return $render->fetch('Adminapi/getExtraCodeRow.tpl');
	}

}

