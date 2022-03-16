<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {
	public function __construct(){
		 parent::__construct();
		$this->load->helper('file');		 
	}
	public function index(){
			ini_set('memory_limit', '-1');
		$myfile_path = dirname(dirname(dirname(__FILE__))).'/resources/backup/';
		
		$dbhost = $this->db->hostname;
		$dbuser = $this->db->username;
		$dbpass = $this->db->password;
		$dbname = $this->db->database;
		$mysqldump=exec('which mysqldump');
		$time=date('Y-m-d_H-i');
		
		$command = "$mysqldump --opt -h $dbhost -u $dbuser -p$dbpass $dbname > $myfile_path".$dbname."_backup_".$time.".sql";
		exec($command);
		$zipcommand="zip --junk-paths ".$myfile_path."BD-backup_".$time.".zip  ".$myfile_path.$dbname."_backup_".$time.".sql";
		exec($zipcommand);
		 
		unlink($myfile_path.$dbname."_backup_".$time.".sql");    
		
		$path = $myfile_path;
		if ($handle = opendir($path)) {
			while (false !== ($filename = readdir($handle))) {
				$filelastmodified = filemtime($path . $filename);
				if((time() - $filelastmodified) > 2592000)
				{
					if($filename != '..' && $filename != '.htaccess'){
						 unlink($path . $filename); 
					} 
				}
			}
			closedir($handle);
		} 
	}  
}
