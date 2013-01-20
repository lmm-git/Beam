<?php
/**
 * Beam Admin-Form ConfigureJob
 *
 * @license    GPLv3
 * @package    Beam/AdminController/Form/Handler/ConfigureJob
 * @author     Leonard Marschke
 */

/**
 * @brief Register FormHandler
 */
class Beam_Form_Handler_Admin_ConfigureJob extends Zikula_Form_AbstractHandler
{
	/**
	 * @brief Setup form.
	 *
	 * @param Zikula_Form_View $view Current Zikula_Form_View instance.
	 * @return boolean
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	function initialize(Zikula_Form_View $view)
	{
		$jid = FormUtil::getPassedValue('jid', null, 'GET');
		if($jid != null)
			$job = $this->entityManager->find('Beam_Entity_Commands', $jid);
		else
			$job = array('active' => true);
		$this->view->assign('job', $job);
		$typeoptions = array(array('text' => $this->__('Standard job'), 'value' => 1), array('text' => $this->__('Job started with replaced field by wildcard %f')));
		$this->view->assign('typeoptions', $typeoptions);
		$this->view->assign('catbase', $this->getVar('GroundCatID'));
	}

	/**
	 * @brief Handle form submission.
	 * @param Zikula_Form_View $view  Current Zikula_Form_View instance.
	 * @param array &$args Arguments.
	 * @return bool|void
	 *
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	function handleCommand(Zikula_Form_View $view, &$args)
	{
		if ($args['commandName'] == 'cancel') {
			LogUtil::RegisterStatus($view->__('Configuring of job cancelled'));
			return $view->redirect(ModUtil::url('Beam', 'admin', 'viewJobs'));
		}


		// check for valid form
		if (!$view->isValid())
			return false;
		$data = $view->getValues();

		$jid = FormUtil::getPassedValue('jid', null, 'GET');

		if($jid != null)
		{
			$display = $this->entityManager->find('Beam_Entity_Commands', $jid);
		}
		else
		{
			$display = new Beam_Entity_Commands();
		}
		/*$display->setName($data['name']);
		$display->setDescription($data['description']);
		$display->setPlace($data['place']);
		$display->setIpDisplay($data['ipDisplay']);
		$display->setIpController($data['ipController']);
		$display->setActive($data['active']);*/
		$display->merge($data);
		
		$this->entityManager->persist($display);
		$this->entityManager->flush();

		LogUtil::registerStatus($this->__('Job configured successfully!'));

		return System::redirect(ModUtil::url('Beam', 'admin', 'viewJobs'));
	}
}
