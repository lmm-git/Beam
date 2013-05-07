<?php
/**
 * Beam PJLink bus
 *
 * @license    GPLv3
 * @package    Beam/PJLink
 */
class Beam_Api_PJLink extends Zikula_AbstractApi
{
	/**
	 * Get beamer video mute by PJLink
	 *
	 *
	 * @author Leonard Marschke
	 * @return 0/1
	 * @todo this function has not the wished function
	 */
	public function getVideoMute()
	{
		$command = '$mute = $prj->get_av_mute();
		if ($mute[1] == Net::PJLink::MUTE_VIDEO) {
			print(\'1\');
		} else {
			print(\'0\');
		}';
		return self::executePJLink($command);
	}
	
	/**
	 * Get beamer video mute by PJLink
	 *
	 *
	 * @author Leonard Marschke
	 * @return 0/1
	 * @todo implemet all power status
	 */
	public function getPower()
	{
		$command = '$mute = $prj->get_power();
		if ($mute == Net::PJLink::POWER_ON) {
			print(\'1\');
		} else {
			print(\'0\');
		}';
		return self::executePJLink($command);
	}
	
	/**
	 * Set beamer video mute by PJLink
	 *
	 *
	 * @author Leonard Marschke
	 * @return true/false
	 */
	public function setVideoMute($state)
	{
		if($state != 1 && $state != 0)
			return false;
		$command = '$prj->set_video_mute(' . $state .  ')';
		self::executePJLink($command);
		return true;
	}
	
	/**
	 * Set beamer video mute by PJLink
	 *
	 *
	 * @author Leonard Marschke
	 * @return true/false
	 */
	public function setPowerState($state)
	{
		if($state != 1 && $state != 0)
			return false;
		$command = '$prj->set_power(' . $state .  ')';
		self::executePJLink($command);
		return true;
	}
	
	/**
	 * Execute PJLink commands
	 *
	 * @author Leonard Marschke
	 * @return true/false
	 */
	private function executePJLink($commands)
	{
		$chars = str_split('abcdefghijklmnopqrstuvwxyz1234567890');
		shuffle($chars);
		$chars = array_slice($chars, 0, 10);
		///TODO switch this into the installer
		if(!file_exists('userdata/Beam/'))
			mkdir('userdata/Beam/');
		$filename = 'userdata/Beam/' . implode('', $chars) . '.pl';
		$file = fopen($filename,"w+");
		rewind($file);
		
		//use right IP and password
			$input = 'use Net::PJLink qw( :RESPONSES );
	
			my $prj = Net::PJLink->new(
				host => \'10.100.100.50\',
				connection_timeout => 1.0,
				auth_password => \'1234\'
				);' . "\n";
		
		$input .= $commands;
		
		fwrite($file, $input);
		
		fclose($file);
		
		///TODO: add setting to enable and disable this
		exec('perl ' . $filename, $return, $status);
		
		unlink($filename);
		
		return $return[count($return) - 1];
	}
	
}

