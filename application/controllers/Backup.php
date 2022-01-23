<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {
	public function __construct(){
		 parent::__construct();
		$this->load->helper('file');		 
	}
	public function index(){
			ini_set('memory_limit', '-1');
			
		$dbhost = $this->db->hostname;
		$dbuser = $this->db->username;
		$dbpass = $this->db->password;
		$dbname = $this->db->database;
		$mysqldump=exec('which mysqldump');
		$time=date('Y-m-d_H-i');
		$myfile_path = dirname(dirname(dirname(__FILE__))).'/resources/backup/';
		$command = "$mysqldump --opt -h $dbhost -u $dbuser -p$dbpass $dbname > $myfile_path".$dbname."_backup_".$time.".sql";
		exec($command);
		$zipcommand="zip ".$myfile_path."BD-backup_".$time.".zip  ".$myfile_path.$dbname."_backup_".$time.".sql";
		exec($zipcommand);
		 
		unlink($myfile_path.$dbname."_backup_".$time.".sql");  	
			
			/* $this->load->dbutil();
			$prefs = array('format' => 'zip', 'filename' => 'Database-backup_' . date('Y-m-d_H-i'));
			$backup = $this->dbutil->backup($prefs);
		
		if (!write_file('./resources/backup/BD-backup_' . date('Y-m-d_H-i') . '.zip', $backup)) {
			 
		}else {
			 
		} */
	}  
}
