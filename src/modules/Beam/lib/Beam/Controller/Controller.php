<?php
/**
 * Beam controller section
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    Beam/Controller
 */
class Beam_Controller_Controller extends Zikula_AbstractController
{
	/**
	 * @brief Check for running server
	 * @return string HTML
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function checkUp()
	{
		ob_end_clean();
		
		echo 'OK';
		
		System::shutdown();
		return true;
	}
	
	/**
	 * @brief Get all tasks for one controller
	 * @return string HTML
	 *
	 * Display overview with all jobs for the displays. Excessive use of JavaScript
	 *
	 * @author Leonard Marschke
	 * @version 0.5
	 */
	public function getTasks()
	{
		//remove all unnecessary output
		ob_end_clean();
		$display = $this->entityManager->getRepository('Beam_Entity_Displays')->findOneBy(array('ipController' => $_SERVER['REMOTE_ADDR']));
		if($display['id'] == '') {
			return false;
		}
		
		
		$em = $this->getService('doctrine.entitymanager');
		$qb = $em->createQueryBuilder();
		$qb->select('t')
			->from('Beam_Entity_Run', 't')
			->where("t.did = $display[id] AND (t.status = 1 OR t.status = 99 OR t.status = 150 OR t.status = 49 OR t.status = 51 OR t.status >= 1000)");
		$tasks = $qb->getQuery()->getArrayResult();
		
		
		foreach($tasks as $key => $task)
		{
			$tasks[$key] = $task;
			$tasks[$key]['command'] = $this->entityManager->find('Beam_Entity_Commands', $task['cid']);
			if($task['status'] >= 1000) {
				$run = $this->entityManager->find('Beam_Entity_Run', $task['id']);
				$this->entityManager->remove($run);
			}
			
		}
		$this->entityManager->flush();
		$this->view->assign('tasks', $tasks);
		echo $this->view->fetch('Controller/getTasks.tpl');
		
		System::shutdown();
		return true;
	}
	/**
	 * @brief Update status
	 * @return string HTML
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function updateCommandStatus()
	{
		ob_end_clean();
		
		$rid = FormUtil::getPassedValue('rid', null, 'GET');
		$status = FormUtil::getPassedValue('status', null, 'GET');
		
		if($rid == null || $status == null)
			return null;
		
		$run = $this->entityManager->find('Beam_Entity_Run', $rid);
		if($status == 100 || $status == 151)
			$this->entityManager->remove($run);
		else {
			$run->setStatus($status);
			$this->entityManager->persist($run);
		}
		$this->entityManager->flush();
		
		
		echo 'OK';
		
		System::shutdown();
		return true;
	}
	
	/**
	 * @brief Update pid
	 * @return string HTML
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function updatePid()
	{
		ob_end_clean();
		
		$rid = FormUtil::getPassedValue('rid', null, 'GET');
		$pid = FormUtil::getPassedValue('pid', null, 'GET');
		
		if($rid == null || $pid == null)
			return null;
		
		$run = $this->entityManager->find('Beam_Entity_Run', $rid);
		$run->setWindowid($pid);
		$this->entityManager->persist($run);
		$this->entityManager->flush();
		
		
		echo 'OK';
		
		System::shutdown();
		return true;
	}
}
