<?php
/**
 * Beam Admin-Form ConfigureDisplay
 *
 * @license    GPLv3
 * @package    Beam/AdminController/Form/Handler/ConfigrueDisplay
 */

/**
 * @brief Register FormHandler
 */
class Beam_Form_Handler_Admin_ConfigureDisplay extends Zikula_Form_AbstractHandler
{
	/**
	 * @brief Setup form.
	 *
	 * @param Zikula_Form_View $view Current Zikula_Form_View instance.
	 * @return boolean
	 *
	 * @author Leonard Marschke
	 * @version 1.1
	 */
	function initialize(Zikula_Form_View $view)
	{
		$did = FormUtil::getPassedValue('did', null, 'GET');
		if($did != null)
			$display = $this->entityManager->find('Beam_Entity_Displays', $did);
		else
			$display = array('active' => true);
		$this->view->assign('display', $display);
		
		$typeoptions = array(
			array(
				'text' => $this->__('None'),
				'value' => 0
			),
			array(
				'text' => $this->__('PJLink V1.0'),
				'value' => 1
			)
		);
		
		$this->view->assign('typeoptions', $typeoptions);
	}

	/**
	 * @brief Handle form submission.
	 * @param Zikula_Form_View $view  Current Zikula_Form_View instance.
	 * @param array &$args Arguments.
	 * @return bool|void
	 *
	 *
	 * @author Leonard Marschke
	 * @version 1.1
	 */
	function handleCommand(Zikula_Form_View $view, &$args)
	{
		if ($args['commandName'] == 'cancel') {
			LogUtil::RegisterStatus($view->__('Configuring of display cancelled'));
			return $view->redirect(ModUtil::url('Beam', 'admin', 'viewDisplays'));
		}


		// check for valid form
		if (!$view->isValid())
			return false;

		$data = $view->getValues();

		$did = FormUtil::getPassedValue('did', null, 'GET');

		if($did != null)
		{
			$display = $this->entityManager->find('Beam_Entity_Displays', $did);
		}
		else
		{
			$display = new Beam_Entity_Displays();
		}
		$display->setName($data['name']);
		$display->setDescription($data['description']);
		$display->setPlace($data['place']);
		$display->setIpDisplay($data['ipDisplay']);
		$display->setIpController($data['ipController']);
		$display->setDisplayControlType($data['dCT']);
		$display->setBlendTime(0);
		$display->setActive($data['active']);
		
		$this->entityManager->persist($display);
		$this->entityManager->flush();

		LogUtil::registerStatus($this->__('Display configured successfully!'));

		return System::redirect(ModUtil::url('Beam', 'admin', 'viewDisplays'));
	}
}
