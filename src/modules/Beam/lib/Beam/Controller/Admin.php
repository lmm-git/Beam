<?php
/**
 * Beam admin area
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    Beam/Admin
 */
class Beam_Controller_Admin extends Zikula_AbstractController
{
	/**
	 * @brief Give overview of all admin jobs
	 * @return string HTML
	 *
	 * @author Leonard Marschke
	 * @version 0.1
	 * @todo all
	 */
	public function main()
	{
		$this->redirect(ModUtil::url('Beam', 'admin', 'dashboard'));
	}
	
	/**
	 * @brief Display controlling
	 * @return string HTML
	 *
	 * Display overview with all jobs for the displays. Excessive use of JavaScript
	 *
	 * @author Leonard Marschke
	 * @version 0.1
	 * @todo all
	 */
	public function dashboard()
	{
		return '<h1>Coming soon</h1>';
	}
	
	/**
	 * @brief Display overview
	 * @return string HTML
	 *
	 * Display overview of all displays.
	 *
	 * @author Leonard Marschke
	 * @version 0.1
	 * @todo all
	 */
	public function viewDisplays()
	{
		if(!SecurityUtil::checkPermission('Beam::', 'Displays::', ACCESS_ADMIN))
			return LogUtil::registerPermissionError();
		
		$displays = $this->entityManager->getRepository('Beam_Entity_Displays')->findBy(array());
		$this->view->assign('displays', $displays);
		return $this->view->fetch('Admin/ViewDisplays.tpl');
	}
	
	/**
	 * @brief Add and edit display
	 * @return string HTML
	 *
	 * Add and edit display form with all avaiable jobs. It is intended to use the FormUtil
	 *
	 * @author Leonard Marschke
	 * @version 0.1
	 * @todo all
	 */
	public function configureDisplay()
	{
		if(!SecurityUtil::checkPermission('Beam::', 'Displays::', ACCESS_ADMIN))
			return LogUtil::registerPermissionError();
		
		$form = FormUtil::newForm($this->name, $this);
		return $form->execute('Admin/ConfigureDisplay.tpl', new Beam_Form_Handler_Admin_ConfigureDisplay());
	}
	
	/**
	 * @brief Add and edit display
	 * @return string HTML
	 *
	 * Remove display. The security question should be done by JavaScript.
	 *
	 * @author Leonard Marschke
	 * @version 0.1
	 * @todo all
	 */
	public function removeDisplay()
	{
		if(!SecurityUtil::checkPermission('Beam::', 'Displays::', ACCESS_ADMIN))
			return LogUtil::registerPermissionError();
		
		$did = FormUtil::getPassedValue('did', null, 'GET');
		if($did == null)
			return LogUtil::registerError($this->__('You must pass a display id (did)'));
		$display = $this->entityManager->find('Beam_Entity_Displays', $did);
		$this->entityManager->remove($display);
		$this->entityManager->flush();
		LogUtil::registerStatus($this->__('Display removed!'));
		return $this->redirect(ModUtil::url('Beam', 'admin', 'viewDisplays'));
	}
	
	/**
	 * @brief Give overview of all jobs
	 * @return string HTML
	 *
	 * Overview of all avaiable jobs for the Displays. With standard checkbox.
	 *
	 * @author Leonard Marschke
	 * @version 0.1
	 * @todo all
	 */
	public function viewJobs()
	{
		return '<h1>Coming soon</h1>';
	}
	
	/**
	 * @brief Add and edit function
	 * @return string HTML
	 *
	 * Add and edit function form with all avaiable jobs. It is intended to use the FormUtil
	 *
	 * @author Leonard Marschke
	 * @version 0.1
	 * @todo all
	 */
	public function configureJob()
	{
		return '<h1>Coming soon</h1>';
	}
	
	/**
	 * @brief Remove function
	 * @return string HTML
	 *
	 * Remove function. The security question should be done by JavaScript.
	 *
	 * @author Leonard Marschke
	 * @version 0.1
	 * @todo all
	 */
	public function removeJob()
	{
		return '<h1>Coming soon</h1>';
	}
}
