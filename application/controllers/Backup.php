<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {
	public function __construct(){
		 parent::__construct();
		$this->load->helper('file');		 
	}
	public function index(){
			ini_set('memory_limit', '-1');
			$this->load->dbutil();
			$prefs = array('format' => 'zip', 'filename' => 'Database-backup_' . date('Y-m-d_H-i'));
			$backup = $this->dbutil->backup($prefs);
		
		if (!write_file('./resources/backup/BD-backup_' . date('Y-m-d_H-i') . '.zip', $backup)) {
			/* echo "Error while creating auto database backup!"; */
		}else {
			/* echo "Database backup has been successfully Created"; */
		}
	}  
}
