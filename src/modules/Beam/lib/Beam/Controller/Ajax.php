<?php
/**
 * Beam ajax controller
 *
 * @license    GPLv3
 * @package    Beam/Ajax
 */
class Beam_Controller_Ajax extends Zikula_AbstractController
{
	/**
	 * @brief Get dashboard main frame
	 * @return string html string
	 *
	 * This function gets the main frame of the Beam dashboard
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function ConfigureJobLoadExtraCodeRow()
	{
		if (!SecurityUtil::checkPermission('Beam::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$no = FormUtil::getPassedValue('no', null, 'POST');
		if($no == null)
			return new Zikula_Response_Ajax_BadData('$no is missing. This is an internal error.');
		$this->view->assign('no', $no);

		return new Zikula_Response_Ajax(ModUtil::apiFunc($this->name, 'Admin', 'getExtraCodeRow', array('no' => $no)));
	}
	
	/**
	 * @brief Get dashboard main frame
	 * @return string html string
	 *
	 * This function gets the main frame of the Beam dashboard
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardLoadMainFrame()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$id = FormUtil::getPassedValue('id', null, 'POST');
		if($id == null)
			return new Zikula_Response_Ajax_BadData('$id is missing. This is an internal error.');
		$this->view->assign('did', $id);

		$categories  = CategoryUtil::getCategoriesByParentID($this->getVar('GroundCatID'));
		$this->view->assign('categories', $categories);
		return new Zikula_Response_Ajax($this->view->fetch('Ajax/LoadMainFrame.tpl'));
	}
	
	/**
	 * @brief Get dashboard main frame script
	 * @return string html string
	 *
	 * This function gets the main frame script of the Beam dashboard
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardLoadMainFrameScript()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$id = FormUtil::getPassedValue('id', null, 'POST');
		if($id == null)
			return new Zikula_Response_Ajax_BadData('$id is missing. This is an internal error.');

		$categories  = CategoryUtil::getCategoriesByParentID($this->getVar('GroundCatID'));
		
		$output = "function Beam_Dashboard_LoadCategories{$id}(id) {\n";
		
		foreach($categories as $cat)
		{
			$output .= "Beam_Dashboard_LoadCategory(id, {$cat['id']});\n";
		}
		$output .= "}\nBeam_Dashboard_LoadCategories{$id}({$id});\n";
		
		return new Zikula_Response_Ajax($output);
	}
	
	/**
	 * @brief Get dashboard display info
	 * @return string html string
	 *
	 * This function gets the display info of one display and displays it on the dashboard
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardLoadDisplayInfo()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$id = FormUtil::getPassedValue('id', null, 'POST');
		if($id == null)
			return new Zikula_Response_Ajax_BadData('$id is missing. This is an internal error.');
		$this->view->assign('did', $id);

		
		return new Zikula_Response_Ajax($this->view->fetch('Ajax/LoadDisplayInfo.tpl'));
	}
	
	
	/**
	 * @brief Get dashboard display control
	 * @return string html string
	 *
	 * This function gets the display control of one display and displays it on the dashboard
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardLoadDisplayControl()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$id = FormUtil::getPassedValue('id', null, 'POST');
		if($id == null)
			return new Zikula_Response_Ajax_BadData('$id is missing. This is an internal error.');
		$this->view->assign('did', $id);

		
		$display = $this->entityManager->find('Beam_Entity_Displays', $id);
		$this->view->assign('display', $display);
		
		return new Zikula_Response_Ajax($this->view->fetch('Ajax/LoadDisplayControl.tpl'));
	}
	
	/**
	 * @brief Get dashboard display control blend time
	 * @return string html string
	 *
	 * This function gets the display control blend time of one display and displays it on the dashboard in the right field
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardLoadDisplayControlBlendTime()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$id = FormUtil::getPassedValue('id', null, 'POST');
		if($id == null)
			return new Zikula_Response_Ajax_BadData('$id is missing. This is an internal error.');

		
		$display = $this->entityManager->find('Beam_Entity_Displays', $id);
		
		return new Zikula_Response_Ajax($display->getBlendTime());
	}
	
	/**
	 * @brief Updating blending time in DB
	 * @return string html string
	 *
	 * This function updates the blend time of the controller in the DB
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardLoadDisplayControlBlendTimeUpdate()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$id = FormUtil::getPassedValue('id', null, 'POST');
		if($id == null)
			return new Zikula_Response_Ajax_BadData('$id is missing. This is an internal error.');

		$value = (float)str_replace(',', '.', FormUtil::getPassedValue('value', null, 'POST'));
		if($value == null)
			return new Zikula_Response_Ajax_BadData('$value is missing. This is an internal error.');
		
		
		
		$display = $this->entityManager->find('Beam_Entity_Displays', $id);
		$display->setBlendTime($value);
		$this->entityManager->persist($display);
		$this->entityManager->flush();
		
		return new Zikula_Response_Ajax(true);
	}
	
	/**
	 * @brief Get dashboard category-box content
	 * @return string html string
	 *
	 * This function gets the content of the category-boxes
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardLoadCategory()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$id = FormUtil::getPassedValue('id', null, 'POST');
		if($id == null)
			return new Zikula_Response_Ajax_BadData('$id is missing. This is an internal error.');
		$this->view->assign('did', $id);
		
		$cid = FormUtil::getPassedValue('cid', null, 'POST');
		if($cid == null)
			return new Zikula_Response_Ajax_BadData('$cid is missing. This is an internal error.');
		
		$jobs = $this->entityManager->getRepository('Beam_Entity_Commands')->findBy(array('category' => $cid));
		$this->view->assign('jobs', $jobs);
		
		$cat = CategoryUtil::getCategoryByID($cid);
		$this->view->assign('cat', $cat);
		
		return new Zikula_Response_Ajax($this->view->fetch('Ajax/LoadCategory.tpl'));
	}
	
	/**
	 * @brief Start special job-event
	 * @return string html string
	 *
	 * Start job by display id, sub-job-id and job id
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardPushSpecialEvent()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$rid = FormUtil::getPassedValue('rid', null, 'POST');
		if($rid == null)
			return new Zikula_Response_Ajax_BadData('$rid is missing. This is an internal error.');
		
		$jid = FormUtil::getPassedValue('jid', null, 'POST');
		if($jid == null)
			return new Zikula_Response_Ajax_BadData('$jid is missing. This is an internal error.');
		
		$sjid = FormUtil::getPassedValue('sjid', null, 'POST');
		if($sjid == null)
			return new Zikula_Response_Ajax_BadData('$sjid is missing. This is an internal error.');
		
		$runParent = $this->entityManager->find('Beam_Entity_Run', $rid);
		if($runParent['id'] == '')
			return new Zikula_Response_Ajax_BadData('$rid is invalid. This is an internal error.');
		
		$run = new Beam_Entity_Run();
		$run->setDid($runParent['did']);
		$run->setCid($jid);
		$run->setStatus(1000 + $sjid);
		$this->entityManager->persist($run);
		$this->entityManager->flush();
		
		return new Zikula_Response_Ajax(ModUtil::apiFunc('Beam', 'Jobs', 'getDashboardLinks', array('rid' => $runParent->getId())));
	}
	
	/**
	 * @brief Start job
	 * @return string html string
	 *
	 * Start job by display id and job id
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardStartJob()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$did = FormUtil::getPassedValue('did', null, 'POST');
		if($did == null)
			return new Zikula_Response_Ajax_BadData('$did is missing. This is an internal error.');
		
		$jid = FormUtil::getPassedValue('jid', null, 'POST');
		if($jid == null)
			return new Zikula_Response_Ajax_BadData('$jid is missing. This is an internal error.');
		
		$run = new Beam_Entity_Run();
		$run->setDid($did);
		$run->setCid($jid);
		$run->setStatus(1);
		$this->entityManager->persist($run);
		$this->entityManager->flush();
		
		return new Zikula_Response_Ajax(ModUtil::apiFunc('Beam', 'Jobs', 'getDashboardLinks', array('rid' => $run->getId())));
	}
	
	
	/**
	 * @brief Changing job status
	 * @return string html string
	 *
	 * Change job status in DB
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardSetJobStatus()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$rid = FormUtil::getPassedValue('rid', null, 'POST');
		if($rid == null)
			return new Zikula_Response_Ajax_BadData('$rid is missing. This is an internal error.');
		
		$state = (int)FormUtil::getPassedValue('state', null, 'POST');
		if($state == null)
			return new Zikula_Response_Ajax_BadData('$state is missing. This is an internal error.');
		
		
		$run = $this->entityManager->find('Beam_Entity_Run', $rid);
		if($run['id'] == '')
			return new Zikula_Response_Ajax_BadData('$rid is invalid. This is an internal error.');
		$run->setStatus($state);
		$this->entityManager->persist($run);
		$this->entityManager->flush();
		
		return new Zikula_Response_Ajax(ModUtil::apiFunc('Beam', 'Jobs', 'getDashboardLinks', array('rid' => $rid)));
	}
	
	/**
	 * @brief Removing job link
	 * @return string html string
	 *
	 * Remove job DB-entry
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardRemoveJobDBEntry()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$rid = FormUtil::getPassedValue('rid', null, 'POST');
		if($rid == null)
			return new Zikula_Response_Ajax_BadData('$rid is missing. This is an internal error.');
		
		$did = FormUtil::getPassedValue('did', null, 'POST');
		if($did == null)
			return new Zikula_Response_Ajax_BadData('$did is missing. This is an internal error.');
		
		$jid = FormUtil::getPassedValue('jid', null, 'POST');
		if($jid == null)
			return new Zikula_Response_Ajax_BadData('$jid is missing. This is an internal error.');
		
		$run = $this->entityManager->find('Beam_Entity_Run', $rid);
		if($run['id'] == '')
			return new Zikula_Response_Ajax_BadData('$rid is invalid. This is an internal error.');
		$this->entityManager->remove($run);
		$this->entityManager->flush();
		
		return new Zikula_Response_Ajax(ModUtil::apiFunc('Beam', 'Jobs', 'getDashboardLinks', array('did' => $did, 'cid' => $jid)));
	}
	
	/**
	 * @brief Set video mute of projector
	 * @return string html string
	 *
	 * Set video mute of projector by choosed control service
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardSetVideoMute()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		/*$did = FormUtil::getPassedValue('did', null, 'POST');
		if($did == null)
			return new Zikula_Response_Ajax_BadData('$did is missing. This is an internal error.');
		$this->view->assign('did', $id);
		*/
		$state = FormUtil::getPassedValue('state', null, 'POST');
		if($state == null)
			return new Zikula_Response_Ajax_BadData('$state is missing. This is an internal error.');
		
		return ModUtil::apiFunc('Beam', 'PJLink', 'SetVideoMute', $state);
		
		}
		
		/**
	 * @brief Start job
	 * @return string htm TODO l string
	 *
	 * Start job by display id and job id
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function DashboardSetPowerState()
	{
		if (!SecurityUtil::checkPermission('Beam::', 'Dashboard::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		/*$did = FormUtil::getPassedValue('did', null, 'POST');
		if($did == null)
			return new Zikula_Response_Ajax_BadData('$did is missing. This is an internal error.');
		$this->view->assign('did', $id);
		*/
		$state = FormUtil::getPassedValue('state', null, 'POST');
		if($state == null)
			return new Zikula_Response_Ajax_BadData('$state is missing. This is an internal error.');
		
		return ModUtil::apiFunc('Beam', 'PJLink', 'SetPowerState', $state);
		
		}
}


