<?php
/**
 * Beam Jobsapi bus
 *
 * @license    GPLv3
 * @package    Beam/Jobsapi
 */
class Beam_Api_Jobs extends Zikula_AbstractApi
{
	/**
	 * Get dashboard links for one job.
	 *
	 *
	 * @author Leonard Marschke
	 * @return string html string
	 */
	public function getDashboardLinks($args)
	{
		if((!isset($args['did']) || !isset($args['cid'])) && !isset($args['rid']))
			return LogUtil::registerError('did and cid or rid must be passed. This is an internal error.');
		
		if(isset($args['rid']))
			$run = $this->entityManager->find('Beam_Entity_Run', $args['rid']);
		else
			$run = $this->entityManager->getRepository('Beam_Entity_Run')->findOneBy(array('did' => $args['did'], 'cid' => $args['cid']));
		
		$command = $this->entityManager->find('Beam_Entity_Commands', $run['cid']);
		
		$output = '';
		
		if(isset($args['cid']))
			$cid = $args['cid'];
		elseif(isset($run['id']))
			$cid = $run->getCid();
		
		if(isset($args['did']))
			$did = $args['did'];
		elseif(isset($run['id']))
			$did = $run->getDid();
		
		if($run['id'] != '') {
			$extraCodes = '';
			#print_r($command->getExtraCode());
			foreach($command->getExtraCode() as $key => $code) {
				$extraCodes .= " | <a href=\"javascript:void(0);\" onclick=\"Beam_Dashboard_PushSpecialEvent({$run[id]}, " . $key . ", {$cid});\">" . $code['title'] . "</a>";
			}
		}
		
		if($run['id'] == '')
		{
			$output .= "<a href=\"javascript:void(0);\" onclick=\"Beam_Dashboard_StartJob({$did}, {$cid});\">" . $this->__('Start job') . "</a>";
		} elseif($run['status'] < 40 && $run['status'] > 0) {
			$output .= "<a href=\"javascript:void(0);\" onclick=\"Beam_Dashboard_SetJobStatus({$run[id]}, 99, {$cid});\">" . $this->__('Stop job (soft)') . "</a>";
			if($command['codePauseStart'] != '') {
				$output .= "&nbsp;|&nbsp;";
				$output .= "<a href=\"javascript:void(0);\" onclick=\"Beam_Dashboard_SetJobStatus({$run[id]}, 49, {$cid});\">" . $this->__('Pause') . "</a>";
			}
			$output .= $extraCodes;
		} elseif($run['status'] < 100 && $run['status'] > 90) {
			$output .= "<a href=\"javascript:void(0);\" onclick=\"Beam_Dashboard_SetJobStatus({$run[id]}, 150, {$cid});\">" . $this->__('Kill job (hard)') . "</a>";
		} elseif($run['status'] < 51 && $run['status'] > 49) {
			$output .= "<a href=\"javascript:void(0);\" onclick=\"Beam_Dashboard_SetJobStatus({$run[id]}, 51, {$cid});\">" . $this->__('Play') . "</a>";
			$output .= "&nbsp;|&nbsp;";
			$output .= "<a href=\"javascript:void(0);\" onclick=\"Beam_Dashboard_SetJobStatus({$run[id]}, 99, {$cid});\">" . $this->__('Stop job (soft)') . "</a>";
			$output .= $extraCodes;
		} elseif($run['status'] < 52 && $run['status'] > 48) {
			$output .= '<i>' . $this->__('Waiting for controller...') . '</i>';
			$output .= "&nbsp;|&nbsp;";
			$output .= "<a href=\"javascript:void(0);\" onclick=\"Beam_Dashboard_SetJobStatus({$run[id]}, 150, {$cid});\">" . $this->__('Kill job (hard)') . "</a>";
		} else {
			$output .= "<a href=\"javascript:void(0);\" onclick=\"Beam_Dashboard_RemoveJobDBEntry({$run[id]}, {$cid}, {$did});\"><i>" . $this->__('Remove run entry (only if code crashed)') . "</i></a>";
		}
		return $output;
	}

}

