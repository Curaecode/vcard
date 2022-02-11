
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logs extends CI_Controller {
	public function __construct()
	{
		 parent::__construct();		 
		 ini_set('max_execution_time', 180000);
		ini_set('fastcgi_read_timeout', 99999999);
		 ini_set('memory_limit', "-1");
		$this->load->model("admin/model");
		 
		
	}
	public function index() {
		$domain = base_url();
		$domain = str_replace('https://', '', $domain);
		$domain = str_replace('/', '', $domain);
		$log_path='/var/log/apache2/domains/';
		 
		if ( file_exists($log_path.$domain.'.log')) {  
			$logs = file_get_contents($log_path .$domain.'.log'); 
			$data['logs'] = $logs;
		} else {
			$data['logs'] = '';
		}
		
		$this->load->view('codebase/logs',$data);
	}		
}
